<?php
	class Database{
		private $cn=false;
		private $res;
		private static $instance=false;

		public static function getInstance(){
			if(!self::$instance) self::$instance=new Database();
			return self::$instance;
		}

		private function connect(){
			$this->cn=mysqli_connect("localhost","root","","play2win");
		}

		public function query($q){
			if(!$this->cn)$this->connect();
			$this->res=mysqli_query($this->cn, $q);
			if(!$this->res) echo mysqli_error($this->cn) . " -- Consulta: " . $q;
		}

		public function fetch(){
			return mysqli_fetch_assoc($this->res);
		}

		public function fetchAll(){
			$aux=array();
			while($fila=$this->fetch()) $aux[]=$fila;
			return $aux;
		}

		public function numRows(){
			return mysqli_num_rows($this->res);
		}

		public function escapeString($str){
			if(!$this->cn)$this->connect();
			return mysqli_escape_string($this->cn, $str);
		}

		public function escapeWildcards($str){
			$str=str_replace("%", "\%", $str);
			$str=str_replace("_", "\_", $str);
			return $str;
		}
	}
?>