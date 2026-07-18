<?php 
	class Generos extends Model{
		//Retorna  un array de generos con todos sus atributos.
		public function getTodos(){
			$this->db->query("SELECT * FROM generos");
			return $this->db->fetchAll();
		}
		//Recibe un string con nombres de generos separados por un separador_entrada y retorna un string con los id_genero en el mismo orden y separados por un separador_salida.
		public function getIdGeneros($elementArray){
			$separador_salida=",";
			$generos=$this->getTodos();
			$primeraVez=0;
			$ids=0;
			for($i=0;$i<count($elementArray);$i++){
				foreach($generos as $genero){
					str_replace("+"," ",$elementArray[$i]);
					if(strtolower($elementArray[$i])==strtolower($genero['nombre_genero'])){
						if(!$primeraVez){
							$ids=$genero['id_genero'];
							$primeraVez=1;
						}else{
							$ids.=$separador_salida . $genero['id_genero'];
						}
					}
				}
			}
			return $ids;
		}
	}
?>