<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $this->expansionEle['nombre'] ?></title>
</head>
<body>

<?php include '../html/header.php'; ?>

<article id="detalles">
			<h1><?=$this->expansionEle['nombre'] ?></h1>
			<br/>
			<section id="imagen">
						<img id="portada" src="static/resources/<?=stringTreatment($this->expansionEle['nombre'])?>/card.jpg" alt="">
				</section>
					<h2>Descripcion</h2>
					<p>
						<?=$this->expansionEle['descripcion'] ?>
					</p>
					<br/>
				<section>
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
					Fecha de lanzamiento: <?=$this->expansionEle['fecha_lanzamiento'] ?>
				</span>
				<br/>
				<span>
					Desarrolladora: <?=$this->expansionEle['nombre_dev'] ?>
				</span>
				<br/>
				<span>
					Editorial: <?=$this->expansionEle['nombre_editor'] ?>
				</span>
				<br/>
				<span>
					Precio: 
					<?php
						if($this->expansionEle['precio'] == 0){
							echo "Gratis";
						}else{
							$this->expansionEle['precio'];
						}
					?>
				</span>
				<br/>
	</section>
</article>
				<?php
			if($this->comprado == true){ ?>
					<form action="" method="post">
						<input type="hidden" name="descarga" value="Descargando <?=$this->expansionEle['nombre']?>">
						<input type="submit" value="Descargar" class="btn">
					</form>
<?php			}
			if($this->descargado == true){
				echo"	<script type='text/javascript'>
						alert('Se a descargado expansion');
						</script>";
			}
			if($this->log == true && $this->carrito == false && $this->comprado == false){
				echo "
				<form action='' method='get'>
					<input type='submit' value='Agregar al carrito' class='btn'>
					<input type='hidden' name='add'>
					<input type='hidden' name='id_expansion' value='"; echo $this->expansionEle['id_expansion'];echo"'>
				</form>";
			}
			if($this->log == true && $this->carrito == true && $this->comprado == false){
				echo "
				<form action='' method='get'>
					<input type='submit' value='Quitar del carrito' class='btn'>
					<input type='hidden' name='del'>
					<input type='hidden' name='id_expansion' value='"; echo $this->expansionEle['id_expansion'];echo"'>
				</form>";
			}			
			if($this->log == true && $this->whish == true && $this->comprado == false){
			echo "<form action='wishlist' method='get'>
					<input type='hidden' name='action' value='del'>
					<input type='hidden' name='id_juego' value='"; echo $this->expansionEle['id_juego'];echo"'>
					<input type='hidden' name='prevUrl' value='"; echo urlencode($this->prevUrl); echo"'>
					<input type='submit' value='Quitar de whishlist' class='btn'>
				</form>";
			};
			if($this->log == true && $this->whish == false && $this->comprado == false){
			echo	"<form action='wishlist' method='get'>
					<input type='hidden' name='action' value='add'>
					<input type='hidden' name='id_juego' value='"; echo $this->expansionEle['id_juego'];echo"'>
					<input type='hidden' name='prevUrl' value='"; echo urlencode($this->prevUrl); echo"'>
					<input type='submit' value='Agregar a whishlist' class='btn'>
				</form>";
			};
			if($this->log == false){
				echo "	<form action='login' method='get'>
							<input type='hidden' name='prevUrl' value='"; echo urlencode($this->prevUrl); echo"'>
							<input type='submit' name='log' value='Agregar al carrito' class='btn'>
							<input type='submit' name='log' value='Agregar a whishlist' class='btn'>
						</form>";
			}
			?>
			<br/>
</body>
</html>