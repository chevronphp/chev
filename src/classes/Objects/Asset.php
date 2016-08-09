<?php

namespace Objects;

class Asset {

	protected $id;
	protected $fname;
	protected $collection;
	protected $objectNumber;
	protected $title;
	protected $description;
	protected $owner;

	public function __construct($assetId, $objectNumber, $fname, $title, $description, $owner, $collection){
		$this->setId($assetId);
		$this->setCollection($collection);
		$this->setObjectNumber($objectNumber);
		$this->setTitle($title);
		$this->setDescription($description);
		$this->setOwner($owner);
		$this->setFname($fname);
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		if(is_null($this->id)){
			$this->id = (int)$id;
		}
	}

	/**
	 *
	 */
	public function getFname(){
		return $this->fname;
	}

	/**
	 *
	 */
	public function setFname($fname){
		$this->fname = $fname;
	}

	/**
	 *
	 */
	public function getCollection(){
		return $this->collection;
	}

	/**
	 *
	 */
	public function setCollection($collection){
		$this->collection = $collection;
	}

	/**
	 *
	 */
	public function getObjectNumber(){
		return $this->objectNumber;
	}

	/**
	 *
	 */
	public function setObjectNumber($objectNumber){
		$this->objectNumber = $objectNumber;
	}

	/**
	 *
	 */
	public function getTitle(){
		return $this->title;
	}

	/**
	 *
	 */
	public function setTitle($title){
		$this->title = $title;
	}

	/**
	 *
	 */
	public function getDescription(){
		return $this->description;
	}

	/**
	 *
	 */
	public function setDescription($description){
		$this->description = $description;
	}

	/**
	 *
	 */
	public function getOwner(){
		return $this->owner;
	}

	/**
	 *
	 */
	public function setOwner($owner){
		$this->owner = $owner;
	}

}
