<?php if (isset($usuario)): ?>
	<h1><?= $usuario->nombre ?></h1>
	<
		<div class="data">
            <p class="descripcion"><?= $usuario->id?></p>
			<p class="description"><?= $usuario->apellidos ?></p>
			<p class="price"><?= $usuario->email ?></p>
			
		</div>
	</div>
<?php else: ?>
	<h1>El usuario no existe</h1>
<?php endif; ?>