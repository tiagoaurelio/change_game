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
	#var $arrayInt = array(6,5,4,3,2,1);

	function insertAd($ad){
		array_push($this->arrayAds, $ad);
	}

	function output($ad, $indice){
		$indice += 1;
		echo("<br/>");
		echo("Anúncio: $indice");
		echo("<br/>");
		echo("Title: ".$ad->title);
		echo("<br/>");
		echo("Description: ".$ad->description);
		echo("<br/>");
	}

	function list(){
		foreach ($this->arrayAds as $indice => $value) {
			if(!empty($value)) {
				$this->output($value, $indice);
			}	
		}
		echo("<br/>");
	}

	function remove($ad) {
		foreach ($this->arrayAds as $indice => $value) {
			if($ad == $value) {
				unset($this->arrayAds[$indice]);
			}
		}
		echo("<br/>");
		echo ("Anúncio do título ".$ad->title." foi removido com sucesso!");
		echo("<br/>");
	}

	function view($ad) {
		foreach ($this->arrayAds as $indice => $value) {
			if ($ad == $value) {
				$this->output($value, $indice);
			}
		}
	}

	function searchByTitle($title) {
			if (($indice = array_search($title, array_column($this->arrayAds, 'title'))) === false) {
				echo("Anúncio não encontrado.");
			}else {
				foreach ($this->arrayAds as $indice => $value) {
				if ($title == $value->title) {
					$this->output($value, $indice);
				}
			}
		}
	}

	function searchByDescription($description) {
			if (($indice = array_search($description, array_column($this->arrayAds, 'description'))) === false) {
				echo("Anúncio não encontrado.");
			}else {
				foreach ($this->arrayAds as $indice => $value) {
				if ($description == $value->description) {
					$this->output($value, $indice);
				}
			}
		}
	}

	function searchByTitleOrDescription($word) {
		if(($indiced = array_search($word, array_column($this->arrayAds, 'description')))!==false){
			foreach ($this->arrayAds as $indiced => $value) {
				if ($word == $value->description) {
					$this->output($value, $indiced);
				}
			}
		}
		elseif (($indicet = array_search($word, array_column($this->arrayAds, 'title')))!==false) {
			foreach ($this->arrayAds as $indicet => $value) {
				if ($word == $value->title) {
					$this->output($value, $indicet);
				}
			}
		}
		elseif ($indiced===false && $indicet===false) {
			echo("Anúncio não encontrado.");
		}
	}

	function searchByPartOfWord($part) {
		$result = array();
		foreach ($this->arrayAds as $indice => $value) {
			$titlePart = strpos($this->arrayAds[$indice]->title, $part);
			$descriptionPart = strpos($this->arrayAds[$indice]->description, $part);
			if($titlePart!==false) {
				$result[] = $this->arrayAds[$indice];
			}
			elseif($descriptionPart!==false) {
			 	$result[] = $this->arrayAds[$indice];
			}
		}
		if (empty($result)===true) {
			echo("Anúncio não encontrado.");
		}else {
			foreach ($result as $indice => $value) {
				$this->output($value, $indice);
			}
		}
	}

	function orderByTitle() {
		$arrayOrderned = array();
		asort($this->arrayAds);
		echo("Lista ordenada pelo título:<br/>");
		foreach ($this->arrayAds as $indice => $value) {
			$arrayOrderned[] = $value;
		}
		foreach ($arrayOrderned as $indice => $value) {
			$this->output($value, $indice);
		}
	}

	function swap($array, $i) {
		$x = $this->arrayAds[$i];
		$this->arrayAds[$i] = $this->arrayAds[$i+1];
		$this->arrayAds[$i+1] = $x;
	}

	function orderByTitle2() {
		echo("Lista ordenada pelo título:<br/>");
		$max = count($this->arrayAds)-2;
		if (count($this->arrayAds > 0)) {
			for ($end=$max; $end>=0; $end--) {
			 	for ($i=0; $i<=$end; $i++) {
			 		if ($this->arrayAds[$i] > $this->arrayAds[$i+1]) {
			 			$this->swap($this->arrayAds, $i);
			 		}
			 	}
			}
		}
		foreach ($this->arrayAds as $indice => $value) {
			$this->output($value, $indice);
		}
	}
}

$site = new Site();
$ad1 = new Ad("Celular", "Dourado");
$site->insertAd($ad1);
$ad2 = new Ad("Rotweiller", "Perigoso");
$site->insertAd($ad2);
$ad3 = new Ad("Abaijour", "Prata");
$site->insertAd($ad3);
$ad4 = new Ad("Carro", "Renault");
$site->insertAd($ad4);
$ad5 = new Ad("Moto", "Laranja");
$site->insertAd($ad5);
$ad6 = new Ad("Pneus", "Velhos");
$site->insertAd($ad6);
$ad7 = new Ad("Dentes", "Humanos");
$site->insertAd($ad7);
$ad8 = new Ad("Zico", "Jogador");
$site->insertAd($ad8);
$ad9 = new Ad("Lateral direito", "Mochila");
$site->insertAd($ad9);
$ad10 = new Ad("Goleiro", "Frangueiro");
$site->insertAd($ad10);
$site->list(); 									#Lista todos os itens do array
$site->orderByTitle2();							#Ordena com a função bubble sort
#$site->orderByTitle();							#Ordena com a função do PHP asort pelo título ou primeiro parâmetro
#$site->list(); 								#Lista todos os itens do array
#$site->remove($ad1); 							#remove um item do array
#$site->view($ad1); 							#visualiza um item do array
#$site->searchByTitle("Rotweiller"); 			#Pesquisa item por título
#$site->searchByDescription("Dourado"); 		#Pesquisa item por descriçao
#$site->searchByTitleOrDescription("Celular");	#Pesquisa por título ou Descrição
#$site->searchByPartOfWord("o");				#Pesquisa por parte da palavra nos anúncios