<?php
	//Retorna un string con un ORDER BY dependiendo de si el $ordernamiento coincide con los ordenamientos predefinidos y el $criterio es valido
	function pasteOrderBy($ordenamiento, $criterio){
		$criterio=strtoupper($criterio);
		if($criterio!='DESC' && $criterio!='ASC')die('Error 1');
		$ordPedido=strtolower($ordenamiento);
		//A la izquierda los valores reales en la tabla, a la derecha lo que viene de la URL
		$ordPredef=array('fecha_lanzamiento'=>'fechalanzamiento',
						'nombre'=>'alfabetico',
						'ingame_players'=>'masjugados',
						'precio'=>'precio');

		foreach($ordPredef as $predefinidos){
			if($ordPedido==$predefinidos){
				//array_search(aguja, pajar) retorna el nombre de la "key" que representa a determinado valor del array.
				return 'ORDER BY ' . array_search($predefinidos, $ordPredef) .' '. $criterio;
			}
		}
	}

	function stringTreatment($string){
		$string=str_replace("\"", "", $string);
		$string=str_replace("?", "", $string);
		$string=str_replace(":", "", $string);
		$string=str_replace("<", "", $string);
		$string=str_replace(">", "", $string);
		$string=str_replace("\\", "", $string);
		$string=str_replace("/", "", $string);
		$string=str_replace("*", "", $string);
		$string=str_replace("|", "", $string);
		return $string;
	}

	/*
	function totalPaginas($totalElem, $maxElemRender, $pag){
		if($totalElem){
			$totalPaginas=ceil($totalElem/$maxElemRender);
			if($pag>$totalPaginas)die("fw/funciones-Error 1");
			if($pag<1)die("fw/funciones-Error 1");
			return $totalPaginas;
		}
	}
	*/

?>
