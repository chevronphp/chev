<?php

namespace Mappers;

use Chevron\DB\PDOWrapper;
use Objects\AssetFactory;
use Objects\Asset;

class AssetMapper {

	protected $dbWrite;
	protected $assetFactory;

	public function __construct(PDOWrapper $dbWrite, AssetFactory $assetFactory){
		$this->dbWrite = $dbWrite;
		$this->assetFactory = $assetFactory;
	}

	public function getFromId($id){
		$row = $this->getFromIds([(int)$id]);
		if(isset($row[$id])){
			return $row[$id];
		}
		return null;
	}

	public function getFromIds(array $ids){
		$sql = "
			select
			  a.asset_id,
			  a.object_number,
			  a.fname,
			  a.title,
			  a.description,
			  a.user_id,
			  u.color color,
			  u.name_family collection
			from assets a
			inner join users u on u.user_id = a.user_id
			where asset_id = %s
		";

		$ids = array_map("intval", $ids);
		$rows = $this->dbWrite->rows($sql, [$ids], true);

		$return = [];
		if($rows){
			foreach($rows as $row){
				$return[$row["asset_id"]] = call_user_func_array([$this->assetFactory, AssetFactory::MAKE], $row);
			}
		}
		return $return;
	}

	public function getAll($limit = null, $sortBy = "asset_id"){
		$limit = (int)$limit;

		$sortBy = $sortBy ?: "asset_id";
		$sort = [
			"asset_id" => "a.asset_id",
			"object"   => "a.object_number",
			"owner"    => "u.user_id",
		];

		$sql = "
			select
			  a.asset_id,
			  a.object_number,
			  a.fname,
			  a.title,
			  a.description,
			  a.user_id,
			  u.color color,
			  u.name_family collection
			from assets a
			inner join users u on u.user_id = a.user_id
			order by {$sort[$sortBy]} asc
		" . ($limit ? " limit {$limit}" : "");

		$rows = $this->dbWrite->rows($sql);

		$return = [];
		if($rows){
			foreach($rows as $row){
				$return[$row["asset_id"]] = call_user_func_array([$this->assetFactory, AssetFactory::MAKE], $row);
			}
		}
		return $return;
	}

	public function getAllFromSearch($limit = null, $searchTerms = ""){
		$limit = (int)$limit;

		$sql = "
			select
			  a.asset_id,
			  a.object_number,
			  a.fname,
			  a.title,
			  a.description,
			  a.user_id,
			  u.color color,
			  u.name_family collection
			from assets a
			inner join users u on u.user_id = a.user_id
			WHERE
				MATCH(a.title) AGAINST (? IN BOOLEAN MODE)
			OR
				MATCH(a.description) AGAINST (? IN BOOLEAN MODE)
			order by a.asset_id asc
		" . ($limit ? " limit {$limit}" : "");

		$rows = $this->dbWrite->rows($sql, [$searchTerms, $searchTerms]);

		$return = [];
		if($rows){
			foreach($rows as $row){
				$return[$row["asset_id"]] = call_user_func_array([$this->assetFactory, AssetFactory::MAKE], $row);
			}
		}
		return $return;
	}

	// public function getFromCategoryIds(array $ids);

	// public function getFromAuthorIds(array $ids);

	public function save(Asset $asset){

		$attrs = [
			"asset_id"      => $asset->getId(),
			"fname"         => $asset->getFname(),
			"object_number" => $asset->getObjectNumber(),
			"title"         => $asset->getTitle(),
			"description"   => $asset->getDescription(),
			"user_id"       => $asset->getUserId(),
			"collection"    => $asset->getCollection(),
		];

		if($asset->getId()){
			$this->dbWrite->update("assets", $attrs, [
				"asset_id" => (int)$asset->getId(),
			]);
		}else{
			$this->dbWrite->insert("assets", $attrs);
			$id = $this->dbWrite->lastInsertId();
			$asset->setId($id);
		}
	}

	public function make($objectNumber, $fname, $title, $description, $userId, $color, $collection = null){
		$asset = $this->assetFactory->make(null, $objectNumber, $fname, $title, $description, $userId, $color, $collection);
		$this->save($asset);
		return $asset;
	}


}
