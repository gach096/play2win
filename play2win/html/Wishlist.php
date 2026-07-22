<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Deseados</title>
</head>
<body>
	<?php include '../html/header.php'; ?>
	<div>
		<?php if($this->productos==NULL){ ?>
			<h2>Tu lista de deseos esta vacia.</h2>
		<?php }else{ ?>
			<?php foreach($this->productos as $producto){ ?>
				<div>
					<?php if($producto['tipo']=='juego'){ ?>
						<a href="juego?id_juego=<?=$producto['id_producto']?>">
						<a class="quitar" href="wishlist?action=del&id_juego=<?=$producto['id_producto']?>&prevUrl=wishlist">Quitar</a>
					<?php }else{ ?>
						<a href="expansion?id_expansion=<?=$producto['id_producto']?>">
						<a class="quitar" href="wishlist?action=del&id_expansion=<?=$producto['id_producto']?>&prevUrl=wishlist">Quitar</a>
					<?php } ?>
						<img src="static/resources/<?=stringTreatment($producto['nombre'])?>/card.jpg" class="card">
						<h2 id="nombre"><?=$producto['nombre']?></h2>
						<h2 id="precio"><?=$producto['precio']?></h2>
					</a>
				</div>
			<?php } ?>
		<?php } ?>
	</div>
</body>
</html>