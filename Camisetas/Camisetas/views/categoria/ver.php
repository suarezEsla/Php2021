<?php if (isset($categoria)) : ?>
	<h1><?= $categoria->nombre ?></h1>

	<?php if ($productos->num_rows == 0)  : ?>
		<p>No hay productos para mostrar</p>
	
	<?php else : ?>

		<?php 

			while (  $product = $productos->fetch_object()) : ?>
			<div class="product">

				<?php if ($product->oferta='si') : ?>

				<a href="<?= base_url ?>producto/ver&id=<?= $product->id ?>">
					<?php if ($product->imagen != null) : ?>
						<img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" />
					<?php else : ?>
						<img src="<?= base_url ?>assets/img/camiseta.png" />
					<?php endif; ?>
					<h2><?= $product->nombre ?></h2>
				</a>
				<!--Si el stock del producto es mayor que 0 se muestra el botón comprar, si no, se muestra 'no disponible'-->
				<?php if ($product->stock > 0) :  ?>
					<p><?= $product->precio ?>$</p>
					<a href="<?= base_url ?>carrito/add&id=<?= $product->id ?>" class="button">Comprar</a>
				<?php else : ?>
					<p class="price"><del><?= $product->precio ?>$</del></p>
					<a href="#" class="button button-red">No disponible</a>
				<?php endif; ?>

				<?php endif; ?>
			</div>
		<?php endwhile; ?>

	<?php endif; ?>

	

<?php else : ?>

	<h1>La categoría no existe</h1>
<?php endif; 

?>

