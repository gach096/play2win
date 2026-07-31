<?php
	Class Query{
		private $queryElementSeparator="&";
		private $queryValueSeparator="-";

		
		function getQuery($array){
			return http_build_query($array,"",$this->queryElementSeparator);
		}
		
		function addQueryValue($arrayQuery,$queryElement,$queryValue){
			
			if(array_key_exists($queryElement,$arrayQuery)){	
				$elementArray=explode($this->queryValueSeparator,$arrayQuery[$queryElement]);
				array_push($elementArray,$queryValue);
				$arrayQuery[$queryElement]=implode($this->queryValueSeparator,$elementArray);
				return $arrayQuery;
			}else{
				$arrayQuery[$queryElement]=$queryValue;
				return $arrayQuery;
			}
		}
		function replaceQueryValue($arrayQuery,$queryElement,$queryValue){
			if(array_key_exists($queryElement,$arrayQuery)){
				$arrayQuery[$queryElement]=$queryValue;
			}
			return $arrayQuery;
		}
		function deleteQueryElement($arrayQuery,$queryElement){
			if(array_key_exists($queryElement,$arrayQuery)){
				unset($arrayQuery[$queryElement]);
			}
			return $arrayQuery;
		}

		function crashDuplicates($arrayQuery,$queryElement,$queryValue){
			$crasheado=0;
			if(array_key_exists($queryElement,$arrayQuery)){
				$elementArray=explode($this->queryValueSeparator,$arrayQuery[$queryElement]);
				for($i=0;$i<count($elementArray);$i++){
					if($elementArray[$i]==$queryValue){
						unset($elementArray[$i]);
						$crasheado=1;
					}
				}
				if($crasheado){
					if(count($elementArray)<1){
						unset($arrayQuery[$queryElement]);
						if(count($arrayQuery)){
							//si el array crasheo pero le quedan elementos
							return $arrayQuery;
						}
						//si el array se quedo sin elementos
						return -1;
					}else{
						$elementStr=implode($this->queryValueSeparator,$elementArray);
						$arrayQuery[$queryElement]=$elementStr;
						return $arrayQuery;
					}
				}
			}
			//si no crasheo o no encontro dos elementos con el mismo nombre
			return null;
		}

		function createQuery($queryElement,$queryValue){
			$arrayQuery=$_GET;
			$q=$this->crashDuplicates($arrayQuery,$queryElement,$queryValue);
			if($q>=0){
				if($q){
					return "?" . $this->getQuery($q);
				}else{
					$q=$this->addQueryValue($arrayQuery,$queryElement,$queryValue);
					return "?" . $this->getQuery($q);
				}
			}
		}
		function createQuery2($queryElement,$queryValue){
			$arrayQuery=$_GET;
			$q=$this->replaceQueryValue($arrayQuery,$queryElement,$queryValue);
			if($q){
				return "?" . $this->getQuery($q);
			}
			$q=$this->addQueryValue($arrayQuery,$queryElement,$queryValue);
			return "?" . $this->getQuery($q);
		}

		function createQuery3($queryElement){
			$arrayQuery=$_GET;
			$q=$this->deleteQueryElement($arrayQuery,$queryElement);
			return "?" . $this->getQuery($q);
		}
	}
?>