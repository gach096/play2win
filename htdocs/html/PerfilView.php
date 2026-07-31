<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>
<?php include 'header.php'; ?>
<?php include 'botoneraUsuario.php'; ?>

<div id="perfil">
    <h1>Datos usuario</h1>
    <?php    
        foreach($this->user as $user){ ?>
        Nombre: <?= $user["nombre"]?>
        <br>
        Email: <?= $user["email"]?>
        <br>
</div>
<?php } ?>
</body>
</html>