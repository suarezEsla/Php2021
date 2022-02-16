<!DOCTYPE HTML>
<html lang="es">

<head>
	<meta charset="utf-8" />
	<title>Tienda de Camisetas</title>
	<link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css" />
</head>

<body>
	<div id="container">
		<!-- CABECERA -->
		<header id="header">
			<div id="logo">
				<img src="<?= base_url ?>assets/img/camiseta.png" alt="Camiseta Logo" />
				<a href="<?= base_url ?>">
					Tienda de camisetas
				</a>
			</div>
		</header>

		<!-- MENU -->
		<?php $categorias = Utils::showCategorias(); ?>
		<nav id="menu">
			<ul>
				<li>
					<a href="<?= base_url ?>">Inicio</a>
				</li>
				<?php while ($cat = $categorias->fetch_object()) : ?>

					<li>
						<?php if ($cat->nombre != 'Ofertas') : ?>
							<a href="<?= base_url ?>categoria/ver&id=<?= $cat->id ?>"><?= $cat->nombre ?></a>
						<?php endif; ?>
					</li>
				<?php endwhile; ?>
				<li>
					<a class="nav-link" href="<?= base_url ?>categoria/mostrarOfertas"><img src='oferta.jpg'>Ofertas<a>
				</li>
			</ul>
			<form class="form-inline" action="buscar.php" method="POST">
				<input  type="search" placeholder="Search" aria-label="Search" name="busqueda">
				<input  type="submit" name="submit" value="Buscar">
			</form>
		</nav>

		<div id="content">