<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Iniciar sesion</title>
    </head>
    <body>
        <?php include '../html/header.php'; ?>
            <div id="email">
                    <form id="log" action="login" method="POST">
                        <?php if(isset($this->prevUrl)){ ?>
                            <input type="hidden" name="prevUrl" value="<?=$this->prevUrl?>">
                        <?php } ?>
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" placeholder="Ingrese email">
                        <br>
                        <label for="pass">Contraseña</label>
                        <input id="pass" type="password" name="pass" placeholder="Ingrese contraseña">
                        <br>
                        <input id="iniciar" type="submit" value="Iniciar sesion">
                    </form>

                    <label for="registro">No tienes cuenta?</label>
                    <?php if(isset($this->prevUrl)) { ?>
                        <a id="registro" href="registro?prevUrl=<?=urlencode($this->prevUrl)?>">Crea una nueva.</a>
                    <?php }else{ ?>
                        <a id="registro" href="registro">Crea una nueva.</a>
                    <?php } ?>
            </div>
    </body>
</html>
