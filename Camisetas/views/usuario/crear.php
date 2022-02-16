<?php if (isset($edit) && isset($usuario) && is_object($usuario)) : ?>
	<h1>Editar usuario <?= $usuario->nombre ?></h1>
	<?php $url_action = base_url . "usuario/save&id=" . $usuario->id; ?>
<?php $nuevo = false; ?>
<?php else : ?>
	<h1>Crear nuevo usuario</h1>
	<?= $nuevo = true; ?>
	<?php $url_action = base_url . "usuario/nuevoUsuario"; ?>
<?php endif; ?>



<div class="form_container">

	<form action="<?= $url_action ?>" method="POST" enctype="multipart/form-data">
		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" value="<?= isset($usuario) && is_object($usuario) ? $usuario->nombre : ''; ?>" />

		<label for="apellidos">Apellidos</label>
		<input type="text" name="apellidos" value="<?= isset($usuario) && is_object($usuario) ? $usuario->apellidos : ''; ?> " />

		<label for="email">e-mail</label>
		<input type="text" name="email" value="<?= isset($usuario) && is_object($usuario) ? $usuario->email : ''; ?>" />

		<!-- El campo password se muestra sólo si es creación de usuario nuevo-->
		<?php if ($nuevo) : ?>
			<label for="password">Contraseña</label>
			<input type="text" name="password" value="<?= isset($usuario) && is_object($usuario) ? $usuario->password : ''; ?>" />
		<?php endif; ?>


		<input type="submit" value="Guardar" />
	</form>
</div>