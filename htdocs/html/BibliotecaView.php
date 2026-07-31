<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Biblioteca</title>
    </head>
    <body>
    <?php include '../html/header.php'; ?>

    <div class="mensaje_menu">
    <?php 
        if($this->vacio == true){
            echo"<p>Actualmente no tienes juegos en tu biblioteca.</p>";
        }
        else{
            if($this->descargado == true){
                echo"	<script type='text/javascript'>
                        alert('Se a descargado el juego');
                        </script>";
            }
            foreach($this->juegosComprados as $a){ ?>
            <span>Nombre: <?=$a["nombre"]?></span>
            <form action="" method="post" id="formu">
                <input type="hidden" name="descarga" value="<?=$a['nombre']?>">
                <input type="submit" value="Descargar" class="btn">
            </form>   
            </br>

       <?php
            }        
    } ?>

    </div>
    </body>
</html>