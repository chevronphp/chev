<?php

namespace Objects;

class AssetFactory {

	const MAKE = "make";

	public function make($assetId, $objectNumber, $fname, $title, $description, $owner, $collection = null){
		return new Asset($assetId, $objectNumber, $fname, $title, $description, $owner, $collection);
	}

}
