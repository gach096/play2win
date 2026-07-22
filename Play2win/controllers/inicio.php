<?php
	require '../fw/fw.php';
	require '../static/JS/Funciones.js';
	require '../models/Juegos.php';
	require '../views/Inicio.php';
	include '../static/CSS/inicio.css';
	$ini=new Inicio();
	$j=new Juegos();

	if(isset($_SESSION['logueado'])){
		$ini->logueado=true;
		$ini->usuNom=$_SESSION['usuNom'];
	}

	$ini->masJugados=$j->getMasJugados(5);
	$ini->novedades=$j->getNovedades(5);
	$ini->gratuitos=$j->getGratuitos(5);
	$ini->masVendidos=$j->getMasVendidos(5);
	$ini->actualizados=$j->getActualizados(5);

	$ini->render();
?>