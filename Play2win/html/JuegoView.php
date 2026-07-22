<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $this->juegoEle['nombre'] ?></title>
</head>
<body>

<?php include '../html/header.php'; ?>

<article id="detalles">
			<h1><?=$this->juegoEle['nombre'] ?></h1>
			<br/>
				<section id="imagen">
						<img id="portada" src="static/resources/<?=stringTreatment($this->juegoEle['nombre'])?>/card.jpg" alt="">
				</section>
				<section id="info">
				<h2>Descripcion</h2>
					<p>
						<?=$this->juegoEle['descripcion'] ?>
					</p>
					<span>
						Generos: 
						<?php 
							foreach($this->generos as $a){ ?>
								<a href="catalogo?filtro=fechaLanzamiento&orden=asc&pag=1&genero=<?=$a["nombre_genero"]?>"><?=$a["nombre_genero"]?></a>
						<?php	}
						?>
					</span>
					<br/>
				<span>
					Fecha de lanzamiento: <?=$this->juegoEle['fecha_lanzamiento'] ?>
				</span>
				<br/>
				<span>
					Desarrolladora: <?=$this->juegoEle['nombre_dev'] ?>
				</span>
				<br/>
				<span>
					Editorial: <?=$this->juegoEle['nombre_editor'] ?>
				</span>
				<br/>
				<span>
					Precio: 
					<?php
						if($this->juegoEle['precio'] == 0){
							echo "Gratis";
						}else{
							echo $this->juegoEle['precio'];
						}
					?>
				</span>
				</section>
</article>

			<?php
			if($this->comprado == true){ ?>
					<form action="" method="post">
						<input type="hidden" name="descarga" value="Descargando <?=$this->juegoEle['nombre']?>">
						<input type="submit" value="Descargar" class="btn">
					</form> 
<?php			}
			if($this->descargado == true){
				echo"	<script type='text/javascript'>
						alert('Se a descargado el juego');
						</script>";
			}
			if($this->log == true && $this->comprado == false && $this->juegoEle['precio'] == 0){
				echo "
				<form action='' method='get'>
					<input type='submit' value='Obtener' class='btn'>
					<input type='hidden' name='obtener'>
					<input type='hidden' name='id_juego' value='"; echo $this->juegoEle['id_juego'];echo"'>
				</form>";
			}
			if($this->log == true && $this->carrito == false && $this->comprado == false && $this->juegoEle['precio'] != 0){
				echo "
				<form action='' method='get'>
					<input type='submit' value='Agregar al carrito' class='btn'>
					<input type='hidden' name='add'>
					<input type='hidden' name='id_juego' value='"; echo $this->juegoEle['id_juego'];echo"'>
				</form>";
			}
			if($this->log == true && $this->carrito == true && $this->comprado == false){
				echo "
				<form action='' method='get'>
					<input type='submit' value='Quitar del carrito' class='btn'>
					<input type='hidden' name='del'>
					<input type='hidden' name='id_juego' value='"; echo $this->juegoEle['id_juego'];echo"'>
				</form>";
			}			
			if($this->log == true && $this->whish == true && $this->comprado == false){
			echo "<form action='wishlist' method='get'>
					<input type='hidden' name='action' value='del'>
					<input type='hidden' name='id_juego' value='"; echo $this->juegoEle['id_juego'];echo"'>
					<input type='hidden' name='prevUrl' value='"; echo $this->prevUrl; echo"'>
					<input type='submit' value='Quitar de whishlist' class='btn'>
				</form>";
			};
			if($this->log == true && $this->whish == false && $this->comprado == false){
			echo	"<form action='wishlist' method='get'>
					<input type='hidden' name='action' value='add'>
					<input type='hidden' name='id_juego' value='"; echo $this->juegoEle['id_juego'];echo"'>
					<input type='hidden' name='prevUrl' value='"; echo $this->prevUrl; echo"'>
					<input type='submit' value='Agregar a whishlist' class='btn'>
				</form>";
			};
			if($this->log == false){
				echo "	<form action='login' method='get'>
							<input type='hidden' name='prevUrl' value='"; echo $this->prevUrl; echo"'>
							<input type='submit' value='Agregar al carrito' class='btn'>
							<input type='submit' name='log' value='Agregar a whishlist' class='btn'>
						</form>";
			}
			?>
			<br/>


<?php 
	if(count($this->expansion)>0) echo "<div id='expan'> Expansiones: </br>";
							foreach($this->expansion as $b){ ?>
								<a href="expansion?id_expansion=<?=$b["id_expansion"]?>"><?= $b["nombre"] ?></a>
								<br>
						<?php	} 
	if(count($this->expansion)>0) echo "</div>"
?>
<?php 
	if(count($this->actualizaciones)>0) echo "<div id='actu'> Actualizaciones: </br>";
							foreach($this->actualizaciones as $b){ ?>
								<span>Nombre: <?= $b["nombre"] ?></span></br>
								<span>Descripcion:</span><br>
								<p><?= $b["descripcion"] ?></p>
								<br>
						<?php	} 
	if(count($this->actualizaciones)>0) echo "</div>"
?>

</body>
</html>