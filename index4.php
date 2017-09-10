<?php

class Ad {
	public $title;
	var $description;
	public $price;

	function __construct($title, $description, $price){
		$this->title = $title;
		$this->description = $description;
		$this->price = $price;
	}
}

class Site {
	var $arrayAds = array();

	function array() {
		print_r($this->arrayAds);
	}

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
		echo("Price: ".$ad->price);
		echo("<br/>");
	}

	function output2($index){
		foreach ($index as $indice => $value) {
			$indice += 1;
			echo("<br/>");
			echo("Anúncio: $indice");
			echo("<br/>");
			echo("Title: ".$value->title);
			echo("<br/>");
			echo("Description: ".$value->description);
			echo("<br/>");
			echo("Price: ".$value->price);
			echo("<br/>");
		}
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

	function swap(&$array, $i) {
		$x = $array[$i];
		$array[$i] = $array[$i+1];
		$array[$i+1] = $x;
	}

	function bubbleSort($data) {
		$indexByTitle = $data;
		$max = count($indexByTitle)-2;
		if (count($indexByTitle) > 0) {
			for ($end=$max; $end>=0;$end--) { 
				for ($i=0; $i <= $end ; $i++) { 
					if ($indexByTitle[$i]->title > $indexByTitle[$i+1]->title) {
						$this->swap($indexByTitle, $i);
					}
				}
			}
		}
		return $indexByTitle;
	}

	function index() {
		$index = $this->arrayAds;
		return $index;
	}

	function mergeSort($data) {
		$indiceM = $data;
		if(count($indiceM)>1) {
            $data_middle = count($indiceM)/2;
            $data_part1 = $this->mergesort(array_slice($indiceM, 0, $data_middle));
            $data_part2 = $this->mergesort(array_slice($indiceM, $data_middle, count($indiceM)));
            $counter1 = $counter2 = 0;
            for ($i=0; $i<count($indiceM); $i++) {
                if($counter1 == count($data_part1)) {
                    $indiceM[$i] = $data_part2[$counter2];
                    ++$counter2;
                } elseif (($counter2 == count($data_part2)) or ($data_part1[$counter1]->description < $data_part2[$counter2]->description)) { 
                    $indiceM[$i] = $data_part1[$counter1];
                    ++$counter1;
                } else {
                    $indiceM[$i] = $data_part2[$counter2];
                    ++$counter2;
                }
            }
        }
        return $indiceM;
	}

	function quickSort($array) {
		$length = count($array);
	
		if($length <= 1){
			return $array;
		}
		else{
			$pivot = $array[0];
			$left = $right = array();
			for($i = 1; $i < count($array); $i++){
				if($array[$i]->price < $pivot->price){
					$left[] = $array[$i];
				}
				else{
					$right[] = $array[$i];
				}
			}
			return array_merge($this->quickSort($left), array($pivot), $this->quickSort($right));
		}
	}

	function create($qtd) {
		for($i=1;$i<$qtd;$i++) {
			$ad = new Ad("teste".$i, "descriçao".$i, 30);
			$this->insertAd($ad);
		}
	}
}

$site = new Site();
$ad1 = new Ad("Celular", "Dourado", 3000.00);
$site->insertAd($ad1);
$ad2 = new Ad("Rotweiller", "Perigoso", 600.00);
$site->insertAd($ad2);
$ad3 = new Ad("Abaijour", "Prata", 25.00);
$site->insertAd($ad3);
$ad4 = new Ad("Carro", "Renault", 25000.00);
$site->insertAd($ad4);
$ad5 = new Ad("Moto", "Laranja", 12250.00);
$site->insertAd($ad5);
$ad6 = new Ad("Pneus", "Velhos", 20.00);
$site->insertAd($ad6);
$ad7 = new Ad("Dentes", "Humanos", 2000.00);
$site->insertAd($ad7);
$ad8 = new Ad("Zico", "Jogador", 300000.00);
$site->insertAd($ad8);
$ad9 = new Ad("Lateral direito", "Mochila", 60000.00);
$site->insertAd($ad9);
$ad10 = new Ad("Goleiro", "Frangueiro", 80000.00);
$site->insertAd($ad10);


$site->create(1000);								#Cria anúncios automáticamente
#$site->array(); 								#Imprime todos os itens do array
$data = $site->index();
#$indexQ = $site->quickSort($data);
#$site->output2($indexQ);
#$mergedData = $site->mergeSort($data);			#Ordena com a função merge sort
#$site->output2($mergedData);					#Impressão de um array
#$site->bubbleByTitle2();						#Ordena com a função bubble sort
#$teste = $site->bubbleSort($data);				#Ordenação utilizando o bubble sort
#$site->output2($teste);						#Imprime o resultado do Bubble sort
#$site->orderByTitle();							#Ordena com a função do PHP asort pelo título ou primeiro parâmetro
#$site->list(); 								#Lista todos os itens do array
#$site->remove($ad1); 							#remove um item do array
#$site->view($ad1); 							#visualiza um item do array
#$site->searchByTitle("Rotweiller"); 			#Pesquisa item por título
#$site->searchByDescription("Dourado"); 		#Pesquisa item por descriçao
#$site->searchByTitleOrDescription("Celular");	#Pesquisa por título ou Descrição
#$site->searchByPartOfWord("o");				#Pesquisa por parte da palavra nos anúncios