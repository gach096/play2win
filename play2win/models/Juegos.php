<?php
	class Juegos extends Model{

		public function getJuegoByName($nombre){
			//agregar validaciones
			$nombre=strtolower($nombre);
			if(is_numeric($nombre)) die("error en juegobyname");
			$this->db->query("	SELECT * FROM juegos j 
								JOIN generos_juego gj ON j.id_juego = gj.id_juego 
								JOIN generos g ON g.id_genero = gj.id_genero
								JOIN devs_juego dj ON dj.id_juego = j.id_juego
								JOIN desarrolladores d ON dj.id_dev = d.id_dev
								JOIN editores_juego ej ON j.id_juego = ej.id_juego
								JOIN editores e ON e.id_editor = ej.id_editor
								WHERE j.nombre = '".$nombre."'
								LIMIT 1");
			return $this->db->fetchAll();
		}
		
		public function getJuegoById($id){
			/*
			if(!is_numeric($id)) die("error1getJuegobyID");
			if($id<=0)die("error2getJuegobyID");
			*/
			if(!ctype_digit($id)) throw new ValidacionException('No es un numero'); //die("noes num");
			if($id<=0) throw new ValidacionException('id no valido'); //die("id invalido");
			$this->db->query("	SELECT * FROM juegos j 
								JOIN generos_juego gj ON j.id_juego = gj.id_juego 
								JOIN generos g ON g.id_genero = gj.id_genero
								JOIN devs_juego dj ON dj.id_juego = j.id_juego
								JOIN desarrolladores d ON dj.id_dev = d.id_dev
								JOIN editores_juego ej ON j.id_juego = ej.id_juego
								JOIN editores e ON e.id_editor = ej.id_editor
								WHERE j.id_juego = '".$id."'");
			return $this->db->fetchAll();
		}

		public function getJuego($id){
			/*
			if(!is_numeric($id)) die("error1getJuego");
			if($id<=0)die("error2getJuego");
			*/
			if(!ctype_digit($id)) throw new ValidacionException('No es un numero'); //die("noes num");
			if($id<=0) throw new ValidacionException('id no valido'); //die("id invalido"); 
			$this->db->query("  SELECT * FROM juegos j
                                WHERE j.id_juego = $id
                                LIMIT 1");
            return $this->db->fetchAll();            
        }

		public function getActualizaciones($id){
			if(!is_numeric($id)) die("error1getActualizaciones");
			if($id<=0)die("error2getActualizaciones");
			$this->db->query("	SELECT * FROM actualizaciones_juego aj
								WHERE aj.id_juego = '".$id."'"
							);
			return $this->db->fetchAll();
		}

		public function getGenerosById($id){
			if(!ctype_digit($id)) throw new ValidacionException('No es un numero'); //die("noes num");
			if($id<=0) throw new ValidacionException('id no valido'); //die("id invalido");
			/*
			if(!is_numeric($id)) die("error1getGenerosbyid");
			if($id<=0)die("error2getGenerosByid");
			*/
			$this->db->query("	SELECT g.nombre_genero FROM juegos j
								JOIN generos_juego gj ON gj.id_juego = j.id_juego
								JOIN generos g ON g.id_genero = gj.id_genero
								WHERE j.id_juego = '".$id."'"
							);
			return $this->db->fetchAll();
		}
		//Recibe string con id_generos separados por coma y retorna un array con los juegos que coincidan con todos los id_genero. Retorna la $cantidad de elementos indicada.
		public function getJuegosByGenero($id_genero, $maxElemRender, $ordenamiento, $criterio, $pag, $totalElem){
			//El atributo $genero deberia proviene de la funcion getIdGeneros() por lo que no requiere validacion
			/*
			if(!is_numeric($maxElemRender))die("Error 1");
			if($maxElemRender<1)die("Error 2");
			if(!is_numeric($pag))die("Error 3");
			if($pag<1)die("Error 4");
			*/

			if($totalElem!=0){

				$limInf=($maxElemRender*$pag)-$maxElemRender;

				//Genera un ORDER BY con los parametros ingresados.
				$orderBy=pasteOrderBy($ordenamiento,$criterio);
				if($id_genero=='todos'){
					$this->db->query("SELECT j.nombre,j.precio,j.id_juego,d.nombre_dev,e.nombre_editor
									FROM juegos j
									LEFT JOIN devs_juego dj 
									ON dj.id_juego = j.id_juego
									LEFT JOIN desarrolladores d 
									ON dj.id_dev = d.id_dev
									LEFT JOIN editores_juego ej 
									ON j.id_juego = ej.id_juego
									LEFT JOIN editores e 
									ON e.id_editor = ej.id_editor
									$orderBy
									LIMIT $limInf,$maxElemRender");

				}else{
					//Cuentas las comas para saber la cantidad de elementos de forma rapida, el +1 es para incluir el ultimo elemento, o al unico en caso de que solo sea 1 elemento.
					$cantElem=substr_count($id_genero, ",")+1;
					
					$this->db->query("SELECT j.nombre,j.precio,j.id_juego,d.nombre_dev,e.nombre_editor
									FROM juegos j
									LEFT JOIN generos_juego gj
									ON j.id_juego=gj.id_juego
									LEFT JOIN devs_juego dj 
									ON dj.id_juego = j.id_juego
									LEFT JOIN desarrolladores d 
									ON dj.id_dev = d.id_dev
									LEFT JOIN editores_juego ej 
									ON j.id_juego = ej.id_juego
									LEFT JOIN editores e 
									ON e.id_editor = ej.id_editor
									WHERE gj.id_genero IN ($id_genero)
									GROUP by j.id_juego
									HAVING COUNT(gj.id_genero)=$cantElem
									$orderBy
									LIMIT $limInf,$maxElemRender");
				}
				return $this->db->fetchAll();
			}
			return null;
		}

		public function getJuegosByGenero2($id_genero, $maxElemRender, $ordenamiento, $criterio, $pag, $totalElem, $buscar){
			//El atributo $genero deberia provenir de la funcion getIdGeneros() por lo que creo que no requiere validacion
			
			if($totalElem!=0){
				/*
				if(!ctype_digit($maxElemRender))die("Error 1");
				if($maxElemRender<1)die("Error 2");
				if(!ctype_digit($pag))die("Error 3");
				if($pag<1)die("Error 4");
				*/
				//if(strlen($buscar)<3)throw new ValidacionException('El texto buscado es demaciado corto');
				if(strlen($buscar)>100)throw new ValidacionException('El texto buscado supera el limite de caracteres');
				$buscar=$this->db->escapeString($buscar);
				$buscar=$this->db->escapeWildcards($buscar);


				$limInf=($maxElemRender*$pag)-$maxElemRender;

				//Genera un ORDER BY con los parametros ingresados.
				$orderBy=pasteOrderBy($ordenamiento,$criterio);
				if($id_genero=='todos'){
					$this->db->query("SELECT j.nombre,j.precio,j.id_juego,d.nombre_dev,e.nombre_editor
									FROM juegos j
									LEFT JOIN devs_juego dj 
									ON dj.id_juego = j.id_juego
									LEFT JOIN desarrolladores d 
									ON dj.id_dev = d.id_dev
									LEFT JOIN editores_juego ej 
									ON j.id_juego = ej.id_juego
									LEFT JOIN editores e 
									ON e.id_editor = ej.id_editor
									WHERE nombre LIKE '%$buscar%'
									$orderBy
									LIMIT $limInf,$maxElemRender");

				}else{
					//Cuentas las comas para saber la cantidad de elementos de forma rapida, el +1 es para incluir el ultimo elemento, o al unico en caso de que solo sea 1 elemento.
					$cantElem=substr_count($id_genero, ",")+1;
					
					$this->db->query("SELECT j.nombre,j.precio,j.id_juego,d.nombre_dev,e.nombre_editor
									FROM juegos j
									LEFT JOIN generos_juego gj
									ON j.id_juego=gj.id_juego
									LEFT JOIN devs_juego dj 
									ON dj.id_juego = j.id_juego
									LEFT JOIN desarrolladores d 
									ON dj.id_dev = d.id_dev
									LEFT JOIN editores_juego ej 
									ON j.id_juego = ej.id_juego
									LEFT JOIN editores e 
									ON e.id_editor = ej.id_editor
									WHERE j.nombre LIKE '%$buscar%' AND gj.id_genero IN ($id_genero)
									GROUP by j.id_juego
									HAVING COUNT(gj.id_genero)=$cantElem
									$orderBy
									LIMIT $limInf,$maxElemRender");
				}

				return $this->db->fetchAll();
			}
			return null;
		}
		public function totalElemByGenero($id_genero){
			if($id_genero=='todos'){
				$this->db->query("SELECT count(j.id_juego) as totalElem
								FROM juegos j");
			}else{
				$cantElem=substr_count($id_genero, ",")+1;
				$this->db->query("SELECT COUNT(id_juego) as totalElem
								FROM juegos
								WHERE id_juego IN
									(SELECT id_juego 
    								FROM generos_juego 
     								WHERE id_genero IN ($id_genero) 
     								GROUP BY id_juego
     								HAVING COUNT(id_genero)=$cantElem)");
			}
			$cantElemTotal=$this->db->fetch();
			return $cantElemTotal['totalElem'];
		}

		public function totalElemByGenero2($id_genero,$buscar){
			//if(strlen($buscar)<3)throw new ValidacionException('El texto buscado es demaciado corto');
			if(strlen($buscar)>100)throw new ValidacionException('El texto buscado supera el limite de caracteres');
			$buscar=$this->db->escapeString($buscar);
			$buscar=$this->db->escapeWildcards($buscar);

			if($id_genero=='todos'){
				$this->db->query("SELECT count(id_juego) as totalElem
								FROM juegos
								WHERE nombre LIKE '%$buscar%'");
			}else{
				$cantElem=substr_count($id_genero, ",")+1;
				$this->db->query("SELECT COUNT(id_juego) as totalElem
								FROM juegos
								WHERE nombre LIKE '%$buscar%' AND id_juego IN
									(SELECT id_juego
    								FROM generos_juego
     								WHERE id_genero
     								IN ($id_genero)
     								GROUP BY id_juego
     								HAVING COUNT(id_genero)=$cantElem)");
			}
			$cantElemTotal=$this->db->fetch();
			return $cantElemTotal['totalElem'];
		}

		public function getMasJugados($limite){
			$this->db->query("SELECT j.nombre,j.precio,j.id_juego,d.nombre_dev,e.nombre_editor
							FROM juegos j
							LEFT JOIN devs_juego dj 
								ON dj.id_juego = j.id_juego
							LEFT JOIN desarrolladores d 
								ON dj.id_dev = d.id_dev
							LEFT JOIN editores_juego ej 
								ON j.id_juego = ej.id_juego
							LEFT JOIN editores e 
								ON e.id_editor = ej.id_editor
							ORDER BY ingame_players DESC 
							LIMIT $limite");
			return $this->db->fetchAll();
		}
		public function getNovedades($limite){
			$this->db->query("SELECT j.nombre,j.precio,j.id_juego,d.nombre_dev,e.nombre_editor 
							FROM juegos j
							LEFT JOIN devs_juego dj 
								ON dj.id_juego = j.id_juego
							LEFT JOIN desarrolladores d 
								ON dj.id_dev = d.id_dev
							LEFT JOIN editores_juego ej 
								ON j.id_juego = ej.id_juego
							LEFT JOIN editores e 
								ON e.id_editor = ej.id_editor
							WHERE fecha_lanzamiento IS NOT NULL 
							ORDER BY fecha_publicacion 
							DESC LIMIT $limite");
			return $this->db->fetchAll();
		}
		public function getMasVendidos($limite){
			$this->db->query("SELECT j.nombre,j.precio,j.id_juego,d.nombre_dev,e.nombre_editor
							FROM juegos j
							LEFT JOIN devs_juego dj 
								ON dj.id_juego = j.id_juego
							LEFT JOIN desarrolladores d 
								ON dj.id_dev = d.id_dev
							LEFT JOIN editores_juego ej 
								ON j.id_juego = ej.id_juego
							LEFT JOIN editores e 
								ON e.id_editor = ej.id_editor
							JOIN compras_juego cj 
								ON j.id_juego=cj.id_juego 
							GROUP BY j.id_juego 
							ORDER BY COUNT(j.id_juego) DESC 
							LIMIT $limite");
			return $this->db->fetchAll();
		}	
		public function getActualizados($limite){
			$this->db->query("SELECT j.nombre,j.precio,j.id_juego,d.nombre_dev,e.nombre_editor
							FROM juegos j
							LEFT JOIN devs_juego dj 
								ON dj.id_juego = j.id_juego
							LEFT JOIN desarrolladores d 
								ON dj.id_dev = d.id_dev
							LEFT JOIN editores_juego ej 
								ON j.id_juego = ej.id_juego
							LEFT JOIN editores e 
								ON e.id_editor = ej.id_editor
							JOIN actualizaciones_juego aj 
								ON j.id_juego=aj.id_juego
							GROUP BY j.id_juego 
							ORDER BY MAX(aj.fecha) DESC 
							LIMIT $limite");
			return $this->db->fetchAll();
		}
		public function getGratuitos($limite){
			$this->db->query("SELECT j.nombre,j.precio,j.id_juego,d.nombre_dev,e.nombre_editor
							FROM juegos j
							LEFT JOIN devs_juego dj 
								ON dj.id_juego = j.id_juego
							LEFT JOIN desarrolladores d 
								ON dj.id_dev = d.id_dev
							LEFT JOIN editores_juego ej 
								ON j.id_juego = ej.id_juego
							LEFT JOIN editores e 
								ON e.id_editor = ej.id_editor
							WHERE precio=0 
							ORDER BY ingame_players DESC 
							LIMIT $limite");
			return $this->db->fetchAll();
		}
	}
?>
