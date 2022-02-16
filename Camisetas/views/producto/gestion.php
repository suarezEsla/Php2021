<h1>Gestión de productos</h1>

<a href="<?=base_url?>producto/crear" class="button button-small">
	Crear producto
</a>

<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
	<strong class="alert_green">El producto se ha creado correctamente</strong>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'): ?>	
	<strong class="alert_red">El producto NO se ha creado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('producto'); ?>
	
<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
	<strong class="alert_green">El producto se ha borrado correctamente</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>	
	<strong class="alert_red">El producto NO se ha borrado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>
	
<table>
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
		<th>PRECIO</th>
		<th>STOCK</th>
		<th>TOTAL VENDIDO</th>
		<th>MAS VENDIDO</th>
		<th>ACCIONES</th>
	</tr>
	<h3>Producto más vendido</h3>
	<?php while($pro = $productos->fetch_object("Producto")): ?>
		
		<tr>
			<td><?=$pro->id;?></td>
			<td><?=$pro->nombre;?></td>
			<td><?=$pro->precio;?></td>
			<td><?=$pro->stock;?></td>
			<td><?=$pro->obtenerTotalProductosVendidos();?></td><!--Producto.php-->
			<td><?php  $pro->obtenerMasVendido(); ?></td>
			
			
			<td>
				<!--Botones editar y eliminar llevan a ProductoController-->
				<a href="<?=base_url?>producto/editar&id=<?=$pro->id?>" class="button button-gestion">Editar</a>
				<a href="<?=base_url?>producto/eliminar&id=<?=$pro->id?>" class="button button-gestion button-red">Eliminar</a>
			</td>
		</tr>
		
		<?php endwhile; ?>
</table>




