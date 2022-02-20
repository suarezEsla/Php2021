<h1>Gestionar categorias</h1>

<a href="<?=base_url?>categoria/crear" class="button button-small">
	Crear categoria
</a>

<table>
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
		<th>TOTAL VENDIDO POR CATEGORÍA</th>
		<th>STOCK</th>
		<th>ACCIONES</th>
		
	</tr>
	<?php while($cat = $categorias->fetch_object("Categoria")): ?>
		<tr>
			<td><?=$cat->id;?></td>
			<td><?=$cat->nombre;?></td>
			<td><?=$cat->generadoPorCategoria();?> €</td>
			<td><?=$cat->stockCategoria();?></td>
			
			<td>
				<!--Botones editar y eliminar llevan a ProductoController-->
				<a href="<?=base_url?>categoria/editar&id=<?=$cat->id?>" class="button button-gestion">Editar</a>
				<a href="<?=base_url?>categoria/eliminar&id=<?=$cat->id?>" class="button button-gestion button-red">Eliminar</a>
			</td>
		</tr>
	<?php endwhile; ?>
</table>
