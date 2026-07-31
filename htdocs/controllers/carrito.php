<?php
    require '../fw/fw.php';
    require '../static/JS/Funciones.js';
    include '../static/CSS/carrito.css';
    require '../models/Usuarios.php';
    require '../views/CarritoView.php';

    if(isset($_SESSION["logueado"])){
        $usuario = new Usuarios();
        $carrito = new CarritoView();
        $carrito->logueado=true;
        $carrito->usuNom=$_SESSION['usuNom'];
            //if para saber si esta no tiene ningun juego en su carrito
        $usuario->getCarritoJuego($_SESSION['usuId']) != 0 ?
        $carrito->listaJuegos = $usuario->getCarritoJuego($_SESSION['usuId']) : $carrito->listaJuegos = false;

        $usuario->getCarritoExpansion($_SESSION['usuId']) != 0 ?
        $carrito->listaExpansiones = $usuario->getCarritoExpansion($_SESSION['usuId']) : $carrito->listaExpansiones = false;
        if($carrito->listaJuegos == false && $carrito->listaExpansiones == false)
            $carrito->vacio = true;
        else{
            $carrito->vacio = false;
        }
        if(isset($_POST['borrarJuego'])){
            $usuario->quitarJuegoCarrito($_SESSION['usuId'],$_POST['borrarJuego']);
            header("Location: carrito");
        }
        if(isset($_POST['borrarExpansion'])){
            $usuario->quitarExpansionCarrito($_SESSION['usuId'],$_POST['borrarExpansion']);
            header("Location: carrito");
        }
        $carrito->render();
    }
    else{
        header("Location: login");
    }

?>