<?php
    require '../fw/fw.php';
    require '../static/JS/Funciones.js';
    include '../static/CSS/compra.css';
	require '../models/Juegos.php';
    require '../models/Expansiones.php';
    require '../views/CompraView.php';
    require '../models/Usuarios.php';

    $compraView = new CompraView();
    if(isset($_SESSION['logueado'])){
		$compraView->logueado=true;
		$compraView->usuNom=$_SESSION['usuNom'];
	}
    if(isset($_SESSION["logueado"])){
        if(isset($_POST["confirmar"])){
            $usuario = new Usuarios();
            $usuario->correcto = validarDatos(  $_POST["nombreApellido"],
                                                $_POST["tarjeta"],
                                                $_POST["mes"],
                                                $_POST["anio"]);
            if($usuario->correcto == true){
                $comprasJuego = $usuario->getCarritoJuego($_SESSION['usuId']);
                if($comprasJuego != 0){
                    foreach($comprasJuego as $a){
                        $usuario->comprarJuego($a['id_juego'],$_SESSION['usuId']);
                        $usuario->quitarJuegoCarrito($_SESSION['usuId'],$a['id_juego']);
                    }
                }
                $comprasExpansion = $usuario->getCarritoExpansion($_SESSION['usuId']);
                if($comprasExpansion != 0){
                    foreach($comprasExpansion as $b){
                        $usuario->comprarExpansion($b['id_expansion'],$_SESSION['usuId']);
                        $usuario->quitarExpansionCarrito($_SESSION['usuId'],$b['id_expansion']);
                    }
                }
                header("Location: confirmacion");
            }
 
        }

    $compraView->render();
    }
    else{
        header("Location: login");
    }

/*
Estas validaciones no son reales, son visuales
*/
    function validarDatos($nomApe, $tarj, $mes, $año){
        $hoy = getdate();
        if(ctype_digit($nomApe)) throw new Exception();
        if(!ctype_digit($tarj)) throw new Exception();
        if(!ctype_digit($mes)) throw new Exception();
        if(!ctype_digit($año)) throw new Exception();
        if(strlen($tarj) != 16) throw new Exception();
        if(strlen($mes)< 1 && strlen($mes)> 2) throw new Exception();
        if(strlen($año) != 4 ) throw new Exception();
        if($mes<1 && $mes>12) throw new Exception();
        if($año<$hoy['year'] && $año>($hoy['year']+5)) throw new Exception();
        return true;
    }
?>