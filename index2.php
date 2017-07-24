<?php

class Ad {
	public $title;
	var $description;

	function __construct($title, $description){
		$this->title = $title;
		$this->description = $description;
	}
}

$arrayAds = array();

$ad1 = new Ad("Dog show", "Rotweiller elegante");
array_push($arrayAds, $ad1);
$ad2 = new Ad("Dog xato", "Vira-lata elegante");
array_push($arrayAds, $ad2);

$countArray = count($arrayAds);
for($x=0;$x < $countArray;$x++){
	echo $arrayAds[$x]->title;
}