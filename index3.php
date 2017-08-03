<?php

class Ad {
	public $title;
	var $description;

	function __construct($title, $description){
		$this->title = $title;
		$this->description = $description;
	}
}

class Site {
	var $arrayAds = array();

	function insertAd($ad){
		array_push($this->arrayAds, $ad);
	}

	function output($key) {
		$id = $key+1;
		echo("<br/>");
		echo ("Anúncio: $id");
		echo("<br/>");
		echo ("Title: ".$this->arrayAds[$key]->title);
		echo("<br/>");
		echo ("Description: ".$this->arrayAds[$key]->description);
		echo("<br/>");
	}

	function output2($ad){
		echo $ad->title;
	}

	function list(){
		echo "lista";
		echo count($this->arrayAds);
		foreach ($this->arrayAds as $indice => $value) {
			if(!empty($value)) {
				$this->output2($value);
			}	
		}
	}

	function remove($ad) {
		$key = array_search($ad, $this->arrayAds);
		$title = $this->arrayAds[$key]->title;
		if(array_search($ad, $this->arrayAds)!==false){
			$key = array_search($ad, $this->arrayAds);
			$title = $this->arrayAds[$key]->title;
			unset($this->arrayAds[$key]);
		}
		echo ("Anúncio do título ".$title." foi removido com sucesso!");
	}

	function view($ad) {
		if(array_search($ad, $this->arrayAds)!==false){
			$key = array_search($ad, $this->arrayAds);
			$this->output($key);
		}
	}

	function searchByTitle($title) {
		$key = array_search($title, array_column($this->arrayAds, 'title'));
		if($key!==false){
			$this->output($key);
		}
		elseif ($key==false) {
			print_r($key);
			echo("Anúncio não encontrado.");
		}
	}

	function searchByDescription($description) {
		$key = array_search($description, array_column($this->arrayAds, 'description'));
		if($key!==false){
			$this->output($key);
		}
		elseif ($key==false) {
			print_r($key);
			echo("Anúncio não encontrado.");
		}
	}

	function searchByTitleOrDescription($word) {
		if(array_search($word, array_column($this->arrayAds, 'description'))!==false){
			$key = array_search($word, array_column($this->arrayAds, 'description'));
			$this->output($key);
		}
		elseif (array_search($word, array_column($this->arrayAds, 'title')) !==false) {
			$key = array_search($word, array_column($this->arrayAds, 'title'));
			$this->output($key);
		}
		elseif ($key==false) {
			echo("Anúncio não encontrado.");
		}
	}

	function searchByPartOfWord($part) {
		$result = array();
		foreach ($this->arrayAds as $key => $value) {
			$titlePart = strpos($this->arrayAds[$key]->title, $part);
			$descriptionPart = strpos($this->arrayAds[$key]->description, $part);
			if($titlePart!==false) {
				$result[] = $this->arrayAds[$key];
			}
			elseif($descriptionPart!==false) {
			 	$result[] = $this->arrayAds[$key];
			}
		}
		return $result;
	}
}

$ad1 = new Ad("Celular", "Dourado");
$site = new Site();
$site->insertAd($ad1);
$ad2 = new Ad("Rotweiller", "Perigoso");
$site->insertAd($ad2);
// $response = $site->searchByPartOfWord("mamameolhando");
// print_r(count($response)>0 ? $response : "Não encontrado");
$site->list(); //Lista todos os itens do array
// $site->remove($ad1); //remove um item do array
// $site->list(); //Lista todos os itens do array
//site->view($ad2); //visualiza um item do array
//$site->searchByTitle("Rotweiller"); //Pesquisa item por título
//$site->searchByDescription("Dourado"); //Pesquisa item por descriçao
//$site->searchByTitleOrDescription("Dourado"); //Pesquisa por título ou Descrição