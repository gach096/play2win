<?php
	require_once '../fw/fw.php';
	require_once '../fw/funciones.php';
	require '../static/JS/Funciones.js';
	require_once '../models/Usuarios.php';
	require_once '../views/Wishlist.php';
	include '../static/CSS/wishlist.css';
	

	$wl=new Wishlist();
	$usu=new Usuarios();
	
	if(isset($_SESSION['logueado'])){
		$wl->logueado=true;
		$wl->usuNom=$_SESSION['usuNom'];
		if(isset($_GET['action'])){
			if($_GET['action']=='add'){
				if(isset($_GET['id_juego']))
					$usu->addToWishlist($_SESSION['usuId'], $_GET['id_juego'], 'juego');
				else if(isset($_GET['id_expansion']))
					$usu->addToWishlist($_SESSION['usuId'], $_GET['id_expansion'], 'expansion');
			}
			if($_GET['action']=='del'){
				if(isset($_GET['id_juego']))
					$usu->removeFromWishlist($_SESSION['usuId'], $_GET['id_juego'], 'juego');
				else if(isset($_GET['id_expansion']))
					$usu->removeFromWishlist($_SESSION['usuId'], $_GET['id_expansion'], 'expansion');
			}
			if(isset($_GET['prevUrl']))
					header("Location: ".$_GET['prevUrl']);
				else
					//Reemplazar por controlador inicio cuando este creado.
                    header("Location: inicio");
		}else{
			$wl->productos=$usu->getWishlist($_SESSION['usuId']);
			$wl->render();
		}
	}else
		header("Location: login?prevUrl=Wishlist");
	
?>