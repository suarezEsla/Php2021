<!-- <h1>Gestión de usuarios</h1> -->
<!--Botón de crear usuario que te lleva a usuario/crear-->
<a href="<?=base_url?>usuario/crear" class="button button-small">
	Crear usuario
</a>


<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
	<strong class="alert_green">Registro completado correctamente</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
	<strong class="alert_red">Registro fallido, introduce bien los datos</strong>
<?php endif; ?>
<?php Utils::deleteSession('register'); ?> 

<?php if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == 'complete'): ?>
	<strong class="alert_green">Edición de usuario completado correctamente</strong>
<?php elseif(isset($_SESSION['usuario']) && $_SESSION['usuario'] == 'failed'): ?>
	<strong class="alert_red">Edición de usuario fallido, introduce bien los datos</strong>
<?php endif; ?>
<?php Utils::deleteSession('usuario'); ?> 

<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
	<strong class="alert_green">El producto se ha borrado correctamente</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>	
	<strong class="alert_red">El producto NO se ha borrado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>


<!--Lista con todos los usuarios actualmente registrados-->
 <table>
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
		<th>APELLIDOS</th>
		<th>e-mail</th>
	</tr>
	
	<?php while($usuario = $usuarios->fetch_object()): ?>
		<tr>
			<td><?=$usuario->id;?></td>
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



		</tr>
	
</table>