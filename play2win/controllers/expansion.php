<?php
	require '../fw/fw.php';
    require '../static/JS/Funciones.js';
    include '../static/CSS/expansionView.css';
    require '../models/Usuarios.php';
	require '../models/Expansiones.php';
	require '../static/JS/Funciones.js';
	require '../views/ExpansionView.php';
    $exp = new Expansiones();
    $usuario = new Usuarios();
    $expansionView = new ExpansionView();

    if(isset($_SESSION['logueado'])){
		$expansionView->logueado=true;
		$expansionView->usuNom=$_SESSION['usuNom'];
	}

    $expansionEle = $exp->getExpansionById($_GET['id_expansion']);
//                  Revisar si tiene el juego comprado
if(isset($_SESSION["logueado"])){
    //  El if de arriba para ver si esta logeado y el lambda de abajo para ver si ese juego lo tiene comprado
    $usuario->comprobarExpansionComprado($_SESSION['usuId'],$_GET['id_expansion']) == 1 ?
    $expansionView->comprado = true : $expansionView->comprado = false;
    $usuario->comprobarExpansionWhishlist($_SESSION['usuId'],$_GET['id_expansion']) == 1 ?
    $expansionView->whish = true : $expansionView->whish = false;
    $usuario->comprobarExpansionCarrito($_SESSION['usuId'],$expansionEle[0]['id_expansion']) == 1 ?
        $expansionView->carrito = true : $expansionView->carrito = false; 
        if(isset($_GET['add'])){
            $usuario->agregarExpansionCarrito($_SESSION['usuId'],$expansionEle[0]['id_expansion']);
            header("Location: expansion?id_expansion=".$expansionEle[0]['id_expansion']);
        }
        if(isset($_GET['del'])){
            $usuario->quitarExpansionCarrito($_SESSION['usuId'],$expansionEle[0]['id_expansion']);
            header("Location: expansion?id_expansion=".$expansionEle[0]['id_expansion']);
        }
        $expansionView->descargado = false;
        if(isset($_POST['descarga'])){
            $file = fopen($expansionEle[0]['nombre'],"a");
            fwrite($file,$_POST['descarga']);
            fclose($file);
            $expansionView->descargado = true;
        }
        $expansionView->log = true;
    }else{
        $expansionView->log = false;
    }
    //                                                  generos
    $expansionView->generos = $exp->getGenerosById($_GET['id_expansion']);
    $expansionView->prevUrl = substr($_SERVER['REQUEST_URI'],10);
    $expansionView->expansionEle = $expansionEle[0];
    $expansionView->prevUrl = substr($_SERVER['REQUEST_URI'],10);
    $expansionView->render();
?>