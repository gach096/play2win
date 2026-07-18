<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registrarse</title>
</head>
<body>
<?php include '../html/header.php'; ?>
<div id="registro">
	<form id="registro" action="registro" method="POST">
        <?php if(isset($this->prevUrl)){ ?>
            <input type="hidden" name="prevUrl" value="<?=$this->prevUrl?>">
        <?php } ?>
        <label for="reg_nombre">Nombre de usuario</label>
        <input id="reg_nombre" type="text" name="reg_nombre" placeholder="Ingrese nombre">
        <br>
        <label for="reg_email">Email</label>
        <input id="reg_email" type="email" name="reg_email" placeholder="Ingrese email">
        <br>
        <label for="reg_pass">Contraseña</label>
        <input id="reg_pass" type="password" name="reg_pass" placeholder="Ingrese contraseña">
        <br>
        <label for="confirmarPass">Repita la contraseña</label>
        <input id="confirmarPass" type="password" name="confirmarPass" placeholder="Ingrese contraseña">
        <br>
        <input id="registrarse" type="submit" value="Registrarse">
    </form>
</div>
</body>
</html>