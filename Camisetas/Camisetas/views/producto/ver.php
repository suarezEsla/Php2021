<?php

	require_once './vendor/autoload.php';

//Conexión a bd
$conexion = new mysqli('localhost','root','','tienda_master');
//Consulta
$consulta = $conexion->query("Select * from productos");

$numero_elementos = $consulta->num_rows;
$numero_elementos_pagina = 2;

//Llamada a zebra_pagination
$pagination = new Zebra_Pagination();
//records() = número de elementos que devuelve la consulta
$pagination->records($numero_elementos);

//Número de elementos por página
$pagination->records_per_page($numero_elementos_pagina);


$page = $pagination->get_page();

$empieza_aqui = (($page -1) * $numero_elementos_pagina);


$sql = "Select * from productos LIMIT $empieza_aqui, $numero_elementos_pagina";
$productos = $conexion->query($sql);


//Incluir hoja de estilos
echo '<link rel="stylesheet" href="./vendor/stefangabos/zebra_pagination/public/css/zebra_pagination.css" type="text/css">';


if (isset($product)) : ?>
	<h1><?= $product->nombre ?></h1>
	<div id="detail-product">
		<div class="image">
			<?php if ($product->imagen != null) : ?>
				<img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" />
			<?php else : ?>
				<img src="<?= base_url ?>assets/img/camiseta.png" />
			<?php endif; ?>
		</div>
		<div class="data">
			<p class="description"><?= $product->descripcion ?></p>
			<?php if ($product->stock > 0) : ?>
				<p class="price"><?= $product->precio ?>$</p>
				<a href="<?= base_url ?>carrito/add&id=<?= $product->id ?>" class="button">Comprar</a>
			<?php else : ?>
				<p class="price"><del><?= $product->precio ?>$</del></p>
				<a href="#" class="button">No disponible</a>
			<?php endif; ?>
		</div>
	</div>

	<?php $pagination->render(); ?>
<?php else : ?>
	<h1>El producto no existe</h1>
<?php endif;?>