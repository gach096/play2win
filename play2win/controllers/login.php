<?php
    require '../fw/fw.php';
    require '../static/JS/Funciones.js';
    require '../static/CSS/login.css';
    require '../models/Usuarios.php';
    require '../views/Login.php';

    $login = new Login();
    $usu = new Usuarios();

    if(!isset($_SESSION["logueado"])){
        //No esta logueado y busca logearse
        if(isset($_POST["email"])&&isset($_POST["pass"])){
            if($datosUsu=$usu->comprobarLogin($_POST["email"],$_POST["pass"])){
                $_SESSION["logueado"] = true;
                $_SESSION['usuId'] = $datosUsu['id_usuario'];
                $_SESSION['usuNom'] = $datosUsu['nombre'];
                $_SESSION['usuTipo'] = $datosUsu['tipo_usuario'];
                if(isset($_POST['prevUrl'])){
                    header("Location: ".$_POST['prevUrl']);
                    exit;
                }else{
                    //Reemplazar por controlador inicio cuando este creado.
                    header("Location: inicio");
                    exit;
                }
            }
        }
        //No esta logueado
        if(isset($_GET['prevUrl']))
            $login->prevUrl=$_GET['prevUrl'];
        else if(isset($_POST['prevUrl'])){
            $login->prevUrl=$_POST['prevUrl'];
        }
        $login->render(); 
    }else
        //Reemplazar por controlador inicio cuando este creado.
        header("Location: inicio");
?>