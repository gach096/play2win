<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Inicio</title>
	</head>
	<body>
		<?php include '../html/header.php'; ?>
		<div id='divInicio'>
			<h2 class="nombreCategoria">Mas jugados</h2>
			<table class="tablaCategoria">
				<tr class="filaCategoria">
					<?php foreach($this->masJugados as $producto){ ?>
						<td class="datoCategoria">
							<a href="juego?id_juego=<?=$producto['id_juego']?>">
								<img class="card" src="static/resources/<?=stringTreatment($producto['nombre'])?>/card.jpg">
								<div class="datoCategoria">
									<p> <?=$producto['nombre']?> </p>
									<?php if($producto['nombre_editor']!=null){ ?>
										<p><?=$producto['nombre_dev']?> / <?=$producto['nombre_editor']?></p>
									<?php }else{ ?>
										<p><?=$producto['nombre_dev']?></p>
									<?php } ?>
									<?php if($producto['precio']!=0){ ?>
										<p>$<?=$producto['precio']?></p>
									<?php }else{ ?>
										<p>Gratis</p>
									<?php } ?>
								</div>
							</a>
						</td>
					<?php } ?>
				</tr>
			</table>

			<h2 class="nombreCategoria">Novedades</h2>
			<table class="tablaCategoria">
				<tr class="filaCategoria">
					<?php foreach($this->novedades as $producto){ ?>
						<td class="elementoCategoria">
							<a href="juego?id_juego=<?=$producto['id_juego']?>">
								<img class="card" src="static/resources/<?=stringTreatment($producto['nombre'])?>/card.jpg">
								<div class="datoCategoria">
									<p> <?=$producto['nombre']?> </p>
									<?php if($producto['nombre_editor']!=null){ ?>
										<p><?=$producto['nombre_dev']?> / <?=$producto['nombre_editor']?></p>
									<?php }else{ ?>
										<p><?=$producto['nombre_dev']?></p>
									<?php } ?>
									<?php if($producto['precio']!=0){ ?>
										<p>$<?=$producto['precio']?></p>
									<?php }else{ ?>
										<p>Gratis</p>
									<?php } ?>
								</div>
							</a>
						</td>
					<?php } ?>
				</tr>
			</table>

			<h2 class="nombreCategoria">Mas vendidos</h2>
			<table class="tablaCategoria">
				<tr class="filaCategoria">
					<?php foreach($this->masVendidos as $producto){ ?>
						<td class="elementoCategoria">
							<a href="juego?id_juego=<?=$producto['id_juego']?>">
								<img class="card" src="static/resources/<?=stringTreatment($producto['nombre'])?>/card.jpg">
								<div class="datoCategoria">
									<p> <?=$producto['nombre']?> </p>
									<?php if($producto['nombre_editor']!=null){ ?>
										<p><?=$producto['nombre_dev']?> / <?=$producto['nombre_editor']?></p>
									<?php }else{ ?>
										<p><?=$producto['nombre_dev']?></p>
									<?php } ?>
									<?php if($producto['precio']!=0){ ?>
										<p>$<?=$producto['precio']?></p>
									<?php }else{ ?>
										<p>Gratis</p>
									<?php } ?>
								</div>
							</a>
						</td>
					<?php } ?>
				</tr>
			</table>

			<h2 class="nombreCategoria">Gratuitos</h2>
			<table class="tablaCategoria">
				<tr class="filaCategoria">
					<?php foreach($this->gratuitos as $producto){ ?>
						<td class="elementoCategoria">
							<a href="juego?id_juego=<?=$producto['id_juego']?>">
								<img class="card" src="static/resources/<?=stringTreatment($producto['nombre'])?>/card.jpg">
								<div class="datoCategoria">
									<p> <?=$producto['nombre']?> </p>
									<?php if($producto['nombre_editor']!=null){ ?>
										<p><?=$producto['nombre_dev']?> / <?=$producto['nombre_editor']?></p>
									<?php }else{ ?>
										<p><?=$producto['nombre_dev']?></p>
									<?php } ?>
									<?php if($producto['precio']!=0){ ?>
										<p>$<?=$producto['precio']?></p>
									<?php }else{ ?>
										<p>Gratis</p>
									<?php } ?>
								</div>
							</a>
						</td>
					<?php } ?>
				</tr>
			</table>

			<h2 class="nombreCategoria">Recientemente actualizados</h2>
			<table class="tablaCategoria">
				<tr class="filaCategoria">
					<?php foreach($this->actualizados as $producto){ ?>
						<td class="elementoCategoria">
							<a href="juego?id_juego=<?=$producto['id_juego']?>">
								<img class="card" src="static/resources/<?=stringTreatment($producto['nombre'])?>/card.jpg">
								<div class="datoCategoria">
									<p> <?=$producto['nombre']?> </p>
									<?php if($producto['nombre_editor']!=null){ ?>
										<p><?=$producto['nombre_dev']?> / <?=$producto['nombre_editor']?></p>
									<?php }else{ ?>
										<p><?=$producto['nombre_dev']?></p>
									<?php } ?>
									<?php if($producto['precio']!=0){ ?>
										<p>$<?=$producto['precio']?></p>
									<?php }else{ ?>
										<p>Gratis</p>
									<?php } ?>
								</div>
							</a>
						</td>
					<?php } ?>
				</tr>
			</table>

			<h2 class="nombreCategoria">Descubre Generos</h2>
			<table id="tablaGeneros">
				<tr class="filaGeneros">
					<td class="datoGeneros">
						<a href="catalogo?filtro=fechaLanzamiento&orden=asc&pag=1&genero=accion">
							<img class="cardGen" src="static/resources/generosInicio/Accion.jpg">
						</a>
					</td>
					<td class="datoGeneros">
						<a href="catalogo?filtro=fechaLanzamiento&orden=asc&pag=1&genero=rpg">
							<img class="cardGen" src="static/resources/generosInicio/rpg.jpg">
						</a>
					</td>
					<td class="datoGeneros">
						<a href="catalogo?filtro=fechaLanzamiento&orden=asc&pag=1&genero=terror">
							<img class="cardGen" src="static/resources/generosInicio/terror.jpg">
						</a>
					</td>
					<td class="datoGeneros">
						<a href="catalogo?filtro=fechaLanzamiento&orden=asc&pag=1&genero=aventura">
							<img class="cardGen" src="static/resources/generosInicio/Aventura.jpg">
						</a>
					</td>
					<td class="datoGeneros">
						<a href="catalogo?filtro=fechaLanzamiento&orden=asc&pag=1&genero=disparos">
							<img class="cardGen" src="static/resources/generosInicio/Disparos.jpg">
						</a>
					</td>
				</tr>
			</table>

			<div>
				<h3>¡Explora nuestro catálogo y descubre tu próximo juego favorito!</h3>
				<a href="catalogo">Mostrar todo</a>
			</div>
		</div>
	</body>
</html>