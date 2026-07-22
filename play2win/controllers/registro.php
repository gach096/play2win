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
        if($_POST['reg_pass'] == $_POST["confirmarPass"]){
            $usu->crearUsuario($_POST["reg_nombre"],$_POST["reg_email"],$_POST["reg_pass"]);
            if(isset($_POST['prevUrl']))
                header("Location: ".$_POST['prevUrl']);
            else
                //Reemplazar por controlador inicio cuando este creado.
                header("Location: inicio");
        }else
            die("Error 1");
    }else{
        if(isset($_GET['prevUrl']))
            $reg->prevUrl=$_GET['prevUrl'];
        $reg->render();
    }
?>