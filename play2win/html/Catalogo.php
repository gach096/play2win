<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Catálogo</title>
		<?php $q=new Query("&","-"); ?>
	</head>
	<body>
		<?php include '../html/header.php'; ?>
		<section id="sectionCatalogo">

			<div id="filtroSuperior">
				<div id="menu">
					<div id="menuFS" class="menuFS" onmouseover="desplegarById('conjuntoElementosFS')" onmouseout="desplegarById('conjuntoElementosFS')">
						<span><button>Filtrar</button></span>
						<div class="conjuntoElementosFS" id="conjuntoElementosFS">
							<span class="elementoFS"><a href="catalogo<?=$q->createQuery2('filtro','fechaLanzamiento')?>">Fecha Lanzamiento</a></span>
							<span class="elementoFS"><a href="catalogo<?=$q->createQuery2('filtro','alfabetico')?>">Alfabetico</a></span>
							<span class="elementoFS"><a href="catalogo<?=$q->createQuery2('filtro','masJugados')?>">Mas Jugados</a></span>
							<span class="elementoFS"><a href="catalogo<?=$q->createQuery2('filtro','precio')?>">Precio</a></span>
						</div>
					</div>

					<div  id="menuFS2" class="menuFS" onmouseover="desplegarById('conjuntoElementosFS2')" onmouseout="desplegarById('conjuntoElementosFS2')">
						<span><button>Orden</button></span>
						<div class="conjuntoElementosFS" id="conjuntoElementosFS2">
							<span class="elementoFS"><a href="catalogo<?=$q->createQuery2('orden','asc')?>">Ascendente</a></span>
							<span class="elementoFS"><a href="catalogo<?=$q->createQuery2('orden','desc')?>">Descendente</a></span>
						</div>
					</div>
				</div>
				
			</div>
			<script>
				desplegarById("conjuntoElementosFS");
				desplegarById("conjuntoElementosFS2");
			</script>
			<?php if($this->productos!=null) { ?>
				<table id="tablaProductos">
					<tr>
					<?php /*Muestra los productos del array productos en la view*/?>
					<?php for($i=0;$i<count($this->productos);$i++) { ?>
						<td>
							<a href="juego?id_juego=<?=$this->productos[$i]['id_juego']?>">
								<img class="card" src="static/resources/<?=stringTreatment($this->productos[$i]['nombre'])?>/card.jpg">
								<div>
									<span> <?=$this->productos[$i]['nombre']?> </span>
									<?php if($this->productos[$i]['nombre_editor']!=null){ ?>
										<span class="productoDeved"><?=$this->productos[$i]['nombre_dev']?> / <?=$this->productos[$i]['nombre_editor']?></span>
									<?php }else{ ?>
										<span class="productoDeved"><?=$this->productos[$i]['nombre_dev']?></span>
									<?php } ?>
									<?php if($this->productos[$i]['precio']!=0){ ?>
										<span>$<?=$this->productos[$i]['precio']?></span>
									<?php }else{ ?>
										<span>Gratis</span>
									<?php } ?>
								</div>
							</a>
						</td>
						<?php /*Limita la cantidad de elementos en cada fila.*/?>
						<?php if($i!=0 && !(($i+1)%$this->maxElemRow)) { ?>
							</tr>
							<tr>
						<?php } ?>
					<?php } ?>
					</tr>
				</table>
			<?php } ?>

			<div id="paginas">
				<?php if(isset($this->totalPaginas)){ ?>
					<?php if($this->totalPaginas>=2){ ?>
						<?php for($i=1;$i<=$this->totalPaginas;$i++){ ?>
							<span><a class="pag" href="catalogo<?=$q->createQuery2('pag',$i)?>"><?=$i?></a></span>
						<?php } ?>
					<?php } ?>
				<?php }?>
			</div>
		</section>

		<aside id="barraLateralDerecha">
			<div id="barraBusqueda">
				<?php if(isset($this->busqueda)) { ?>
					<input id="busqueda" type="text" placeholder="Buscar" value='<?=$this->busqueda?>'>
				<?php }else{ ?> 
					<input id="busqueda" type="text" placeholder="Buscar">
				<?php } ?>
				
				<button id="buscar" onclick="buscar('<?=$q->createQuery3('buscar')?>','busqueda','buscar')">Buscar</button>
			</div>

			<div class="filtroLateral">										
				<span class="menuFL"><button onclick="desplegarById('conjuntoElementosFL')">GÉNERO</button></span>
				<?php /*Muestra todos los generos en el array generos del view y redirecciona con un get cuando se le da clic a uno*/?>
				<div id="conjuntoElementosFL">
					<?php foreach($this->generos as $genero) { ?>
						<a class="elementoFL" href="catalogo<?=$q->createQuery('genero',strtolower($genero['nombre_genero']))?>"> <?=$genero['nombre_genero']?> </a>
					<?php } ?>
				</div>
			</div>

		</aside>

	</body>
	<?php include '../html/footer.php'; ?>
</html>
