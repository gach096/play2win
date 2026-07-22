<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contraseña</title>
</head>
<body>
    
<?php include 'header.php'; ?>|
<?php include 'botoneraUsuario.php'; ?>

<div id="pass">
    <h2>Cambiar Contraseña</h2>
    <br>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $this->user?>">
        <input type="password" name="actualPass" id="" placeholder="actual contraseña">
        <input type="password" name="newPass" id="" placeholder="nueva contraseña">
        <input type="password" name="repeatNewPass" id="" placeholder="Repetir nueva contraseña">
        <input type="submit" value="Cambiar" class="btn">
    </form>
</div>
</body>
</html>