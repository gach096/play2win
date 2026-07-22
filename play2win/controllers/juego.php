<?php
	require '../fw/fw.php';
    require '../static/JS/Funciones.js';
    require '../models/Usuarios.php';
	require '../models/Juegos.php';
    require '../models/Expansiones.php';
	require '../views/juegoView.php';

    $juego = new Juegos();
    $juegoView = new JuegoView();
    $exp = new Expansiones();
    $usuario = new Usuarios();

    if(isset($_SESSION['logueado'])){
		$juegoView->logueado=true;
		$juegoView->usuNom=$_SESSION['usuNom'];
	}

    $juegoElegido = $juego->getJuegoById($_GET['id_juego']);

//                  Revisar si tiene el juego comprado
    if(isset($_SESSION["logueado"])){
        //  El if de arriba para ver si esta logeado y el lambda de abajo para ver si ese juego lo tiene comprado
        $usuario->comprobarJuegoComprado($_SESSION['usuId'],$_GET['id_juego']) == 1 ?
        $juegoView->comprado = true : $juegoView->comprado = false;
        $usuario->comprobarJuegoWhishlist($_SESSION['usuId'],$_GET['id_juego']) == 1 ?
        $juegoView->whish = true : $juegoView->whish = false;    
        $usuario->comprobarJuegoCarrito($_SESSION['usuId'],$juegoElegido[0]['id_juego']) == 1 ?
        $juegoView->carrito = true : $juegoView->carrito = false; 
        if(isset($_GET['add'])){
            $usuario->agregarJuegoCarrito($_SESSION['usuId'],$juegoElegido[0]['id_juego']);
            header("Location: juego?id_juego=".$juegoElegido[0]['id_juego']);
        }
        if(isset($_GET['obtener'])){
            //Nunca confiar en el precio que venga del cliente: se vuelve a chequear el precio real en la base.
            if($juegoElegido[0]['precio'] == 0 && $juegoView->comprado == false){
                $usuario->comprarJuego($juegoElegido[0]['id_juego'],$_SESSION['usuId']);
            }
            header("Location: juego?id_juego=".$juegoElegido[0]['id_juego']);
        }
        if(isset($_GET['del'])){
            $usuario->quitarJuegoCarrito($_SESSION['usuId'],$juegoElegido[0]['id_juego']);
            header("Location: juego?id_juego=".$juegoElegido[0]['id_juego']);
        }
        $juegoView->descargado = false;
        if(isset($_POST['descarga'])){
            $file = fopen($juegoElegido[0]['nombre'],"a");
            fwrite($file,$_POST['descarga']);
            fclose($file);
            $juegoView->descargado = true;
        }
        $juegoView->log = true;
    }else{
        $juegoView->log = false;
    }



//                                  generos
    $juegoView->generos = $juego->getGenerosById($_GET['id_juego']);

//                                                  Actualizaciones
    $juegoView->actualizaciones = $juego->getActualizaciones($_GET['id_juego']) ;
//                                                  fin actualizaciones
$uriParts = explode('?', $_SERVER['REQUEST_URI'], 2);
$juegoView->prevUrl = basename($uriParts[0]) . (isset($uriParts[1]) ? '?'.$uriParts[1] : '');
    $juegoView->juegoEle = $juegoElegido[0];
    $juegoView->expansion = $exp->getOnlyExpansion($juegoElegido[0]["id_juego"]);    
    $juegoView->render();


?>