<?php
    require '../fw/fw.php';
    require '../static/JS/Funciones.js';
    require '../static/CSS/confirmacion.css';
    require '../views/ConfirmacionView.php';

    if(isset($_SESSION["logueado"])){
        $confir = new ConfirmacionView();
        $confir->render();
    }
    else{
        header("Location: login");
    }

?>