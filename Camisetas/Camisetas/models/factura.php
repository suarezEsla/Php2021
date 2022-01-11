<?php

// include autoloader
require_once './dompdf/autoload.inc.php';
require_once './views/pedido/detalle.php';

		use Dompdf\Dompdf;
		// instantiate dompdf class
		$dompdf = new Dompdf();
		
		// pdf content
		$html = '<h3>Datos del cliente:</h3>
		Nombre: <?= $usuario->nombre . " " . $usuario->apellidos ?><br>
		e-mail: <?= $usuario->email ?><br><br>
		
		<h3>Dirección de envío:</h3>
		Provincia: <?= $pedido->provincia ?> <br />
		Cuidad: <?= $pedido->localidad ?> <br />
		Direccion: <?= $pedido->direccion ?> <br /><br />
		
		<h3>Datos del pedido:</h3>
		<strong>Estado: <?= Utils::showStatus($pedido->estado) ?> </strong><br />
		Número de pedido: <?= $pedido->id ?> <br />
		Total a pagar: <?= $pedido->coste ?> $ <br />';
		
		
		
		// load html
		$dompdf->loadHtml($html);
		
		// set paper size and orientation
		$dompdf->setPaper('A4', 'landscape');
		
		// render html as pdf
		$dompdf->render();
		
		// output the pdf to browser
		$dompdf->stream();
		
		

?>