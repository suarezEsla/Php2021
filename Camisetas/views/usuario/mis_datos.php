<!-- <h1>Gestión de usuarios</h1> -->
<!--Botón de crear usuario que te lleva a usuario/crear-->
<a href="<?= base_url ?>usuario/crear" class="button button-small">
	Crear usuario
</a>


<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
	<strong class="alert_green">Registro completado correctamente</strong>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed') : ?>
	<strong class="alert_red">Registro fallido, introduce bien los datos</strong>
<?php endif; ?>
<?php Utils::deleteSession('register'); ?>

<?php if (isset($_SESSION['usuario']) && $_SESSION['usuario'] == 'complete') : ?>
	<strong class="alert_green">Edición de usuario completado correctamente</strong>
<?php elseif (isset($_SESSION['usuario']) && $_SESSION['usuario'] == 'failed') : ?>
	<strong class="alert_red">Edición de usuario fallido, introduce bien los datos</strong>
<?php endif; ?>
<?php Utils::deleteSession('usuario'); ?>

<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete') : ?>
	<strong class="alert_green">El producto se ha borrado correctamente</strong>
<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete') : ?>
	<strong class="alert_red">El producto NO se ha borrado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>


<?php if (isset($usuarios)) : ?>

	<table>
		<tr>
			<th>Nombre de usuario</th>
			<th>Apellidos</th>
			<th>Rol</th>
			<th>email</th>
		</tr>

		<?php foreach ($usuarios as $key => $user) : ?>
			<tr>
				<td>
					<?= $user->getNombre()   ?>
				</td>
				<td>
					<?= $user->getApellidos() ?>
				</td>
				<td>
					<?= $user->getRol()      ?>
				</td>
				<td>
					<?= $user->getEmail()    ?>
				</td>

				<td>

					<?php if ($user->getId() == $_SESSION['identity']->id) : ?>
						<a href="<?=base_url?>usuario/editar&id=<?=$user->getId()?>">Gestionar datos personales</a>
							
					<?php endif ?>
					</td>
			<?php endforeach; ?>
			




			</tr>
		<?php endif; ?>
	</table>