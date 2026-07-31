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
            try{
                if ($_POST['newPass'] !== $_POST['repeatNewPass']) {
            		throw new ValidacionException("Las contraseñas nuevas no coinciden.");
        		}
                $usuario->updatePass($_POST['id'], $_POST['newPass'], $_POST['actualPass']);
        		header("Location: perfil");
                
            }catch(ValidacionException $e){
                $usuView->error = $e->getMessage();
            }
        }
        $usuView->user = $_SESSION['usuId'];
        $usuView->render();
    }else
        //No esta logueado
        header("Location: Login");

?>