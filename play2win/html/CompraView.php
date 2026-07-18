<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra</title>
</head>
<body>
<?php include '../html/header.php'; ?>


<div id="datos">
<form action="" method="post"> 
    Nombre y apellido: <input type="text" name="nombreApellido" id="nomApe" placeholder="Nombre y apellido">
    <br/>
    Numero de tarjeta: <input type="number" name="tarjeta" id="tarj" placeholder="Numero de tarjeta">
    <br/>
    Mes Vencimiento: <input type="number" name="mes" id="mes" placeholder="Mes de vencimiento">
    <br/>
    Año Vencimiento: <input type="number" name="anio" id="año" placeholder="Año de vencimiento">
    <br/>
    <input type="submit" name="confirmar" value="Comprar" id="confirmar" class="btn">
</form>
</div>
</body>
</html>