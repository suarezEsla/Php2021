<?php if(isset($edit) && isset($usuario) && is_object($usuario)): ?>
	<h1>Editar usuario <?=$usuario->nombre?></h1>
	<?php $url_action = base_url."usuario/save&id=".$usuario->id; 
    ?>
	
<?php else: ?>
	<h1>Crear nuevo usuario</h1>
	<?php $url_action = base_url."usuario/save"; ?>
    
<?php endif; ?>
	
<div class="form_container">
	
	<form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" value="<?=isset($usuario) && is_object($usuario) ? $usuario->nombre : ''; ?>"/>

		<label for="apellidos">Apellidos</label>
		<input type="text" name="Apellidos" value="<?=isset($usuario) && is_object($usuario) ? $usuario->apellidos : ''; ?> " />

		<label for="email">e-mail</label>
		<input type="text" name="email" value="<?=isset($usuario) && is_object($usuario) ? $usuario->email : ''; ?>"/>

     <!--    <label for="password">Contraseña</label>
	<input type="password" name="password" required/> -->
		

		<input type="submit" value="Guardar" />
	</form> 
</div>