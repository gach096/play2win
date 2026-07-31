<?php
    require '../fw/fw.php';
    require '../models/Usuarios.php';
    require '../views/PerfilView.php';
    include '../static/CSS/perfil.css';
    require '../static/JS/Funciones.js';
    
    if(isset($_SESSION["logueado"])){
        //No esta logueado y busca logearse
        $usuario = new Usuarios();
        $usuView = new PerfilView();
        $usuView->logueado=true;
        $usuView->usuNom=$_SESSION["usuNom"];
        //get usuario y pasarle la variable de sesion id_usuario
        $usuView->user = $usuario->getUsuario($_SESSION['usuId']);

        $usuView->render();
    }else
        //No esta logueado
        header("Location: Login");
?>