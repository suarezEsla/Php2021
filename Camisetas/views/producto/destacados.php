<h1>Algunos de nuestros productos</h1>
<?php

require_once './vendor/autoload.php';

//Conexión a bd
$conexion = new mysqli('localhost','root','','tienda_master');
//Consulta
$consulta = $conexion->query("Select * from productos");

$numero_elementos = $consulta->num_rows;
$numero_elementos_pagina = 6;

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

/* $sql = "UPDATE usuarios SET nombre='KKK', apellidos='KKK', email='KKK' , password='KKK', rol='user', imagen=NULL"; 
		echo $sql;
		die(); */

 while($product = $productos->fetch_object()): ?>
	<div class="product">
		<a href="<?=base_url?>producto/ver&id=<?=$product->id?>">
			<?php if($product->imagen != null): ?>
				<img src="<?=base_url?>uploads/images/<?=$product->imagen?>" />
			<?php else: ?>
				<img src="<?=base_url?>assets/img/camiseta.png" />
			<?php endif; ?>
			<h2><?=$product->nombre?></h2>
		</a>
		<?php if($product->stock > 0) :  ?>
		<p><?=$product->precio?>$</p>
		<a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="button">Comprar</a>
		<?php else :?>
			<p class="price"><del><?= $product->precio ?>$</del></p>
					<a href="#" class="button" >No disponible</a>
				<?php endif; ?>	
	</div>
<?php endwhile; 

//Sacar los botones de cambio de página
$pagination->render();

?>


