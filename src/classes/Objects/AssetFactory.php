<?php

namespace Objects;

class AssetFactory {

	const MAKE = "make";

	public function make($assetId, $objectNumber, $fname, $title, $description, $owner, $color, $collection = null){
		return new Asset($assetId, $objectNumber, $fname, $title, $description, $owner, $color, $collection);
	}

}
