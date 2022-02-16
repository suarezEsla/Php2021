




<?php if (isset($categoria)) : ?>
	<h1><?= $categoria->nombre ?></h1>
	<?php if ($productos->num_rows == 0) : ?>
		<p>No hay productos para mostrar</p>
	<?php else : ?>




		<?php
		while ($product = $productos->fetch_object()) : ?>
			<div class="product">







<!--Si el producto está en oferta-->
				<?php if ($product->oferta = 'si') : ?>
					<a href="<?= base_url ?>producto/ver&id=<?= $product->id ?>">
						<?php if ($product->imagen != null) : ?>
							<img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" />
							<h2><?= $product->descripcion ?></h2>
							<p><?= $product->precio ?>$</p>
							<li>
									<p>Producto rebajado!! Antes <del> <?= Utils::precioRebajado($product->precio) ?></p>
								</del></li>
						<?php else: ?>

							<!--Si el producto no está en oferta-->
			<a href="<?= base_url ?>producto/ver&id=<?= $product->id ?>">
						<?php if ($product->imagen != null) : ?>
							<img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" />
							<h2><?= $product->descripcion ?></h2>
							<p><?= $product->precio ?>$</p>
							<?php else: ?>
							<img src="<?= base_url ?>assets/img/camiseta.png" />
							<?php endif; ?>

							
						<?php endif; ?>

				

						<!--Tanto si está en oferta como si no, si hay stock o no, da la opción de comprar o no-->
					<?php if ($product->stock > 0) :  ?>
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
