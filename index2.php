<?php

class Ad {
	var $title;
	var $description;

	function __construct($title, $description){
		$this->title = $title;
		$this->description = $description;
	}
}

class AdsList {
	var $arrayAds = array();
	var $qttArray = count($this->arrayAds);

	function insert_ad($ad){
		for($i = 0; $i < $qttArray; $i++) {
			array_push($this->arrayAds[$i], $ad);
		}
	}

	function view_ad($ad){
		print_r($this->arrayAds[$i]);
	}

	function remove_ad($ad){
		unset( $this->$arrayAds[$ad]);
	}
}

$ad1 = new Ad("Dog show", "Rotweiller elegante");
$ad2 = new Ad("Iphone", "Iphone 8 novo");

$site = new AdsList();
$site->insert_ad($ad);