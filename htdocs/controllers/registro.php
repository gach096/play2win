<?php
	require '../fw/fw.php';
	require '../models/Usuarios.php';
    require '../views/registro.php';
    include '../static/CSS/registro.css';
    require '../static/JS/Funciones.js';
	$usu = new Usuarios();
    $reg = new Registro();
	
	//No esta logueado y busca registrarse
	if(isset($_POST['reg_nombre'])&&isset($_POST['reg_email'])&&isset($_POST['reg_pass'])&&isset($_POST["confirmarPass"])){
        try{
            if($_POST['reg_pass'] !== $_POST["confirmarPass"]){
                throw new ValidacionException("Las contraseñas no coinciden.");
            }
            $usu->crearUsuario($_POST["reg_nombre"],$_POST["reg_email"],$_POST["reg_pass"]);
                
            if(isset($_POST['prevUrl']))
                header("Location: ".$_POST['prevUrl']);
            else
                //Reemplazar por controlador inicio cuando este creado.
                header("Location: inicio");
        }catch(ValidacionException $e){
            $reg->error = $e->getMessage();
        }
    }
    if(isset($_GET['prevUrl'])){
    	$reg->prevUrl=$_GET['prevUrl'];
    }
	$reg->render();
?>