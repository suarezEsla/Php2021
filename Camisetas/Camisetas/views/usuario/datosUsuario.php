<?php if (isset($gestion)): ?>

	<h1>Gestionar datos de usuario (No admin)</h1>
<?php else: ?>
	<h1>Mis datos</h1>
<?php endif; ?>
<table>
	<tr>
		<th>Nombre</th>
		<th>Apellidos</th>
		<th>email</th>
	</tr>
	<?php
	while ($usuario = $usuarios->fetch_object()):
		?>

		
			<tr>
			
			<td><?=$usuario->nombre;?></td>
			<td><?=$usuario->apellidos;?></td>
			<td><?=$usuario->email;?></td>
			<td>

			<!--LLama a la funcion edit de UsuarioController/editar()-->
				<a href="<?=base_url?>usuario/editar&id=<?=$usuario->id?>" class="button button-gestion">Editar</a>
				<a href="<?=base_url?>usuario/eliminar&id=<?=$usuario->id?>" class="button button-gestion button-red">Eliminar</a>
			</td>
		</tr>
			
		

	<?php endwhile; ?>
</table>