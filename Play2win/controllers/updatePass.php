<?php

    require '../fw/fw.php';
    require '../models/Usuarios.php';
    require '../views/updatePassView.php';
    include '../static/CSS/updatePass.css';
    require '../static/JS/Funciones.js';

    if(isset($_SESSION["logueado"])){
        //No esta logueado y busca logearse
        $usuView = new updatePassView();
        $usuario = new Usuarios();
        $usuView->logueado=true;
        $usuView->usuNom=$_SESSION["usuNom"];
        if(isset($_POST['id']) && isset($_POST['newPass']) && isset($_POST['repeatNewPass'])){
            $us = $usuario->getUsuario($_POST['id']);
var_dump($us);
//compara que la contraseña guardada sea la misma qe la contraseña de bd y tmb compara que la nueva contraseña sea igual a la confirmacion
// de la nueva contraseña
            if($_POST['newPass'] == $_POST['repeatNewPass'] && $us[0]['contrasenia'] ==  sha1($_POST['actualPass'])){
                $usuView->user = $usuario->updatePass($_POST['id'],$_POST['newPass']);
                header("Location: perfil");                
            }
            else{
                //msj de error para poner 
            }
        }
        $usuView->user = $_SESSION['usuId'];
        $usuView->render();
    }else
        //No esta logueado
        header("Location: Login");

?>