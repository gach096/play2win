<?php
	require '../fw/fw.php';
	require '../static/JS/Funciones.js';
	include '../static/CSS/catalogo.css';
	require '../models/Juegos.php';
	require '../models/Generos.php';
	require '../views/Catalogo.php';

	if(!isset($_GET['filtro'])||!isset($_GET['orden'])||!isset($_GET['pag']))
		header("Location: catalogo?filtro=fechaLanzamiento&orden=desc&pag=1");

	$j=new Juegos();
	$g=new Generos();
	$c=new Catalogo();
	$q=new Query("&","-");

	if(isset($_SESSION['logueado'])){
		$c->logueado=true;
		$c->usuNom=$_SESSION['usuNom'];
	}

	$maxElemRender=5;
	$maxElemRow=5;

	$c->generos=$g->getTodos();
	$c->prevUrl=$_SERVER['REQUEST_URI'];
	$c->maxElemRender=$maxElemRender;
	$c->maxElemRow=$maxElemRow;


	if(isset($_GET['genero']))
		$id_generos=$g->getIdGeneros(explode("-",$_GET['genero']));
	else
		$id_generos='todos';
	

	if(isset($_GET['buscar'])){
		$c->busqueda=$_GET['buscar'];
		$totalElem=$j->totalElemByGenero2($id_generos,$_GET['buscar']);
	}else{
		$totalElem=$j->totalElemByGenero($id_generos);
	}


	if($totalElem){
		if(!$_GET['pag'])throw new ValidacionException('No se ingreso pagina.');
		if($_GET['pag']<1)throw new ValidacionException('El numero de pagina es menor que el admitido.');
		if(!ctype_digit($_GET['pag']))throw new ValidacionException('El numero de pagina contiene caracteres invalidos.');
		$totalPaginas=ceil($totalElem/$maxElemRender);
		if($_GET['pag']>$totalPaginas) header("Location: ". $q->createQuery2('pag','1'));
		/*if($_GET['pag']>$totalPaginas)throw new ValidacionException('El numero de pagina es mayor que el admitido.');*/
		if(isset($_GET['buscar'])){
			$c->productos=$j->getJuegosByGenero2($id_generos,
												$maxElemRender,
												$_GET['filtro'],
												$_GET['orden'],
												$_GET['pag'],
												$totalElem,
												$_GET['buscar']);
		}else{
			$c->productos=$j->getJuegosByGenero($id_generos,
												$maxElemRender,
												$_GET['filtro'],
												$_GET['orden'],
												$_GET['pag'],
												$totalElem);
		}
		$c->totalPaginas=$totalPaginas;
	} 	
	$c->render();
	/*ToDo:
	*/
?>