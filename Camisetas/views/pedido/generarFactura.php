<h3>Datos del cliente:</h3>
	Nombre: <?= $usuario->nombre . " " . $usuario->apellidos ?><br>
	e-mail: <?= $usuario->email ?><br><br>

	<h3>Dirección de envío:</h3>
	Provincia: <?= $pedido->provincia ?> <br />
	Cuidad: <?= $pedido->localidad ?> <br />
	Direccion: <?= $pedido->direccion ?> <br /><br />

	<h3>Datos del pedido:</h3>
	<strong>Estado: <?= Utils::showStatus($pedido->estado) ?> </strong><br />
	Número de pedido: <?= $pedido->id ?> <br />
	Total a pagar: <?= $pedido->coste ?> $ <br />
	Productos:
    <h3>Datos del cliente:</h3>
	Nombre: <?= $usuario->nombre . " " . $usuario->apellidos ?><br>
	e-mail: <?= $usuario->email ?><br><br>

	<h3>Dirección de envío:</h3>
	Provincia: <?= $pedido->provincia ?> <br />
	Cuidad: <?= $pedido->localidad ?> <br />
	Direccion: <?= $pedido->direccion ?> <br /><br />

	<h3>Datos del pedido:</h3>
	<strong>Estado: <?= Utils::showStatus($pedido->estado) ?> </strong><br />
	Número de pedido: <?= $pedido->id ?> <br />
	Total a pagar: <?= $pedido->coste ?> $ <br />
	Productos:
