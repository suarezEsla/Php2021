<?php
require_once 'models/Pedido.php';
require_once 'models/Usuario.php';
include_once 'vendor/autoload.php';

use Dompdf\Dompdf;

class pedidoController
{

	public function hacer()
	{

		require_once 'views/pedido/pasoPrevioHacer.php';
	}


	public function direccionHabitual()
	{
		if (isset($_SESSION['identity'])) {
			$usuario_id = $_SESSION['identity']->id;
			$direccionHabitual = isset($_POST['direccionHabitual']) ? $_POST['direccionHabitual'] : false;
			$direccionNueva = isset($_POST['nuevaDireccion']) ? $_POST['nuevaDireccion'] : false;

			if (!empty($direccionHabitual)) {
				$usuarios = new Usuario();

				$consultaDireccion = $usuarios->consultaDireccion($usuario_id);

				/* var_dump($consultaDireccion); die(); */

				$json = json_encode($consultaDireccion["direccion_habitual"]);

				#Prueba... NÓTESE que NO usamos $Datos, sino $json
				/* var_dump($json); die(); */




				header("Location:" . base_url . 'pedido/hacer?v=' . $json);
			} else {
				header("Location:" . base_url . 'pedido/hacer');
			}
		}
	}


	public function add()
	{
		if (isset($_SESSION['identity'])) {
			$usuario_id = $_SESSION['identity']->id;
			$provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
			$localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
			$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;




			$stats = Utils::statsCarrito();
			$coste = $stats['total'];

			if ($provincia && $localidad && $direccion) {
				// Guardar datos en bd
				$pedido = new Pedido();
				$pedido->setUsuario_id($usuario_id);
				$pedido->setProvincia($provincia);
				$pedido->setLocalidad($localidad);
				$pedido->setDireccion($direccion);
				$pedido->setCoste($coste);




				$save = $pedido->save();

				// Guardar linea pedido
				$save_linea = $pedido->save_linea();

				if ($save && $save_linea) {
					$_SESSION['pedido'] = "complete";
				} else {
					$_SESSION['pedido'] = "failed";
				}
			} else {
				$_SESSION['pedido'] = "failed";
			}

			header("Location:" . base_url . 'pedido/confirmado');
		} else {
			// Redigir al index
			header("Location:" . base_url);
		}
	}



	public function confirmado()
	{
		if (isset($_SESSION['identity'])) {
			$identity = $_SESSION['identity'];
			$pedido = new Pedido();
			$pedido->setUsuario_id($identity->id);

			$pedido = $pedido->getOneByUser();

			$pedido_productos = new Pedido();
			$productos = $pedido_productos->getProductosByPedido($pedido->id);
		}
		require_once 'views/pedido/confirmado.php';
	}


	//Saca los pedidos POR USUARIO 
	public function mis_pedidos()
	{
		Utils::isIdentity();
		$usuario_id = $_SESSION['identity']->id;
		$pedido = new Pedido();

		// Sacar los pedidos del usuario
		$pedido->setUsuario_id($usuario_id);
		$pedidos = $pedido->getAllByUser();

		require_once 'views/pedido/mis_pedidos.php';
	}



	//Se llama desde mis_pedidos.php con el id del usuario
	public function detalle()
	{
		Utils::isIdentity();

		if (isset($_GET['id'])) {
			$id = $_GET['id'];

			// Sacar el pedido
			$pedido = new Pedido();
			$pedido->setId($id);
			$pedido = $pedido->getOne();

			//Sacar los datos de los usuarios
			$usuario = new Usuario();
			$usuario->setId($pedido->usuario_id);
			$usuario = $usuario->getOne();

			// Sacar los poductos
			$pedido_productos = new Pedido();
			$productos = $pedido_productos->getProductosByPedido($id);

		



			require_once 'views/pedido/detalle.php';



			/* if (base_url . 'pedido/crearPdf') {
				$pdf = $pedido_productos->sacarPdf($id);
			} */
		} else {
			header('Location:' . base_url . 'pedido/mis_pedidos');
		}
	}


	/* //Crear PDF
	public function crearPdf()
	{

		Utils::isIdentity();

		if (isset($_GET['id'])) {
			$id = $_GET['id'];

			// Sacar el pedido
			$pedido = new Pedido();
			$pedido->setId($id);
			$pedido = $pedido->getOne();

			//Sacar los datos de los usuarios
			$usuario = new Usuario();
			$usuario->setId($pedido->usuario_id);
			$usuario = $usuario->getOne();

			// Sacar los poductos
			$pedido_productos = new Pedido();






			require_once 'views/pedido/detalle.php';
		} else {
			header('Location:' . base_url . 'pedido/mis_pedidos');
		};
	} */


	//Obtiene TODOS los pedidos
	public function gestion()
	{
		Utils::isAdmin();
		$gestion = true;

		$pedido = new Pedido();
		$pedidos = $pedido->getAll();
		//Obtiene todos los pedidos y redirige a mis_pedidos (vista)
		require_once 'views/pedido/mis_pedidos.php';
	}

	public function estado()
	{
		Utils::isAdmin();
		if (isset($_POST['pedido_id']) && isset($_POST['estado'])) {
			// Recoger datos form
			$id = $_POST['pedido_id'];
			$estado = $_POST['estado'];

			// Upadate del pedido
			$pedido = new Pedido();
			$pedido->setId($id);
			$pedido->setEstado($estado);
			$pedido->edit();

			header("Location:" . base_url . 'pedido/detalle&id=' . $id);
		} else {
			header("Location:" . base_url);
		}
	}
}
