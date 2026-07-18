<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
</head>
<body>
<?php include '../html/header.php'; ?>
<div id="carrito">
    <?php            $total = 0;
        if($this->vacio == false){
            if($this->listaJuegos != false){ 
                foreach($this->listaJuegos as $a){ ?>
                   <div>
                        <span id="nomJuego"><?= $a['nombre'] ?></span>
                        <span id="precioJuego">$<?= $a['precio'] ?></span> 
                        <form action="" method="post" id="formu">
                            <input type="hidden" name="borrarJuego"value="<?=$a['id_juego']?>">
                            <button type="submit" class="btn">Borrar</button>
                        </form>
                    </div>
                    <br>
            <?php $total = $total +$a['precio'];   }
            }
           if($this->listaExpansiones != false){
                foreach($this->listaExpansiones as $b){ ?>
                <div>
                        <span id="nomExpansion"><?= $b['nombre'] ?></span>
                        <span id="precioExpansion"><?= $b['precio'] ?></span> 
                        <form action="" method="post" id="formu">
                            <input type="hidden" name="borrarExpansion"value="<?=$b['id_expansion']?>">
                            <button type="submit" class="btn">Borrar</button>
                        </form>
                </div>
                <br> 
        <?php $total = $total +$b['precio'];   }
            } ?>
            <span>Total: $<?=$total?></span>
            <form action="compra">
                <button class="btn" type="submit">Confirmar</button>
            </form>
        <?php }else{ ?> 
            <p>Carrito vacio, agrega un juego</p>
       <?php } ?>
    </div>
</body>
</html>