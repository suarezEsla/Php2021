<?php
require_once 'models/Usuario.php';

class usuarioController
{

	public function index()
	{
		echo "Controlador Usuarios, Acción index";
	}

	public function registro()
	{
		require_once 'views/usuario/registro.php';
	}





	public function save()
	{
		if (isset($_POST)) {

			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			/* $password = isset($_POST['password']) ? $_POST['password'] : false; */

			if ($nombre && $apellidos && $email) {
				$usuario = new Usuario();
				$usuario->setNombre($nombre);
				$usuario->setApellidos($apellidos);
				$usuario->setEmail($email);

				if (isset($_GET['id'])) {
					$id = $_GET['id'];
					$usuario->setId($id);

					$save = $usuario->edit();
				} else {
					$save = $usuario->save();
				}

				if ($save) {
					$_SESSION['usuario'] = "complete";
				} else {
					$_SESSION['usuario'] = "failed";
				}
			} else {
				$_SESSION['usuario'] = "failed";
			}
		} else {
			$_SESSION['usuario'] = "failed";
		}
		header('Location:' . base_url . 'Usuario/gestion');
	}

	public function nuevoUsuario()
	{
		if (isset($_POST)) {

			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			$password = isset($_POST['password']) ? $_POST['password'] : false;

			if ($nombre && $apellidos && $email) {
				$usuario = new Usuario();
				$usuario->setNombre($nombre);
				$usuario->setApellidos($apellidos);
				$usuario->setEmail($email);
				$usuario->setPassword($password);

				if (isset($_GET['id'])) {
					$id = $_GET['id'];
					$usuario->setId($id);

					$save = $usuario->edit();
				} else {
					$save = $usuario->save();
				}

				if ($save) {
					$_SESSION['usuario'] = "complete";
				} else {
					$_SESSION['usuario'] = "failed";
				}
			} else {
				$_SESSION['usuario'] = "failed";
			}
		} else {
			$_SESSION['usuario'] = "failed";
		}
		header('Location:' . base_url . 'Usuario/gestion');
	}


//Ver más acerca de un usuario (nº de pedidos, etc...)
public function verMasUsuario(){
	Utils::isAdmin();
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$edit = true;

		$usuario = new Usuario();
		$usuario->setId($id);

		$usuario = $usuario->getOne();

		 require_once "views/usuario/verMas.php"; 
	} else {
		header('Location:' . base_url . 'Usuario/gestion');
	}
}










	//Editar para admin
	public function editar()
	{
		Utils::isAdmin();
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$edit = true;

			$usuario = new Usuario();
			$usuario->setId($id);

			$usuario = $usuario->getOne();

			require_once 'views/usuario/crear.php';
		} else {
			header('Location:' . base_url . 'Usuario/gestion');
		}
	}

	




	public function eliminar()
	{
		Utils::isAdmin();

		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$usuario = new Usuario();
			$usuario->setId($id);

			$delete = $usuario->delete();
			if ($delete) {
				$_SESSION['delete'] = 'complete';
			} else {
				$_SESSION['delete'] = 'failed';
			}
		} else {
			$_SESSION['delete'] = 'failed';
		}

		header('Location:' . base_url . 'Usuario/gestion');
	}




	public function login()
	{
		if (isset($_POST)) {
			// Identificar al usuario
			// Consulta a la base de datos
			$usuario = new Usuario();
			$usuario->setEmail($_POST['email']);
			$usuario->setPassword($_POST['password']);

			$identity = $usuario->login();

			if ($identity && is_object($identity)) {
				$_SESSION['identity'] = $identity;

				if ($identity->rol == 'admin') {
					$_SESSION['admin'] = true;
				}
			} else {
				$_SESSION['error_login'] = 'Identificación fallida !!';
			}
		}
		header("Location:" . base_url);
	}

	public function logout()
	{
		if (isset($_SESSION['identity'])) {
			unset($_SESSION['identity']);
		}

		if (isset($_SESSION['admin'])) {
			unset($_SESSION['admin']);
		}

		header("Location:" . base_url);
	}






	public function gestion()
	{
		Utils::isAdmin();

		$usuario = new Usuario();
		$usuarios = $usuario->getAll();

		require_once 'views/usuario/gestion.php';
	}

	public function crear()
	{
		Utils::isAdmin();
		require_once 'views/usuario/crear.php';
	}
} // fin clase