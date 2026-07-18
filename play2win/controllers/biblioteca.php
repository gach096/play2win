<?php
    require '../fw/fw.php';
    require '../static/JS/Funciones.js';
    require '../models/Usuarios.php';
    require '../views/BibliotecaView.php';
    include '../static/CSS/biblioteca.css';
    
if(isset($_SESSION['logueado'])){
    $usuario = new Usuarios();
    $biblioteca = new BibliotecaView();
    $biblioteca->logueado=true;
    $biblioteca->usuNom=$_SESSION["usuNom"];
    $biblioteca->juegosComprados = $usuario->getCompras($_SESSION["usuId"]);
    if($biblioteca->juegosComprados == NULL)
        $biblioteca->vacio = true;
    /*
    if($biblioteca->juegosComprados == 0)
        $biblioteca->vacio = true;
    else{
        $biblioteca->vacio = false;
    }
    */
    $biblioteca->descargado = false;
    if(isset($_POST['descarga'])){
        $file = fopen($_POST['descarga'],"a");
        fwrite($file,"Descargando ".$_POST['descarga']);
        fclose($file);
        $biblioteca->descargado = true;
    }
    $biblioteca->render();
}else
    header("Location: login?prevUrl=biblioteca");

?>