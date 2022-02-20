<?php if(isset($edit) && isset($categoria) && is_object($categoria)): ?>
	<h1> Editar categoría <?=$categoria->nombre?></h1>
	<?php $url_action = base_url."categoria/save&id=".$categoria->id; ?>
    

    <?php else: ?>
	<h1>Crear nueva categoria</h1>
	<?php $url_action = base_url."categoria/save"; ?>
<?php endif; ?>



<form action="<?=base_url?>categoria/save" method="POST">
	<label for="nombre">Nombre</label>
	<input type="text" name="nombre" required/>
	
	<input type="submit" value="Guardar" />
</form>