<?php
require_once 'models/Categoria.php';
require_once 'models/Producto.php';

class categoriaController
{

	public function index()
	{
		Utils::isAdmin();
		$categoria = new Categoria();
		$categorias = $categoria->getAll();

		require_once 'views/categoria/index.php';
	}


	//Función que llama a obtenerOfertas, donde se sacan los productos que están en oferta 

	public function mostrarOfertas(){
		$categoria = new mysqli();

		$categoria->nombre = "Ofertas";

		$producto  = new Producto();

		$productos = $producto->obtenerOfertas();
		require_once 'views/categoria/ver.php';
	}




	public function ver()
	{
		if (isset($_GET['id'])) {
			$id = $_GET['id'];

			// Conseguir categoria
			$categoria = new Categoria();
			$categoria->setId($id);
			$categoria = $categoria->getOne();

			// Conseguir productos;
			$producto = new Producto();
			$producto->setCategoria_id($id);
			$productos = $producto->getAllCategory();
		}

		require_once 'views/categoria/ver.php';
	}

	public function crear()
	{
		Utils::isAdmin();
		require_once 'views/categoria/crear.php';
	}

	/* public function save()
	{
		Utils::isAdmin();
		if (isset($_POST) && isset($_POST['nombre'])) {
			// Guardar la categoria en bd
			$categoria = new Categoria();
			$categoria->setNombre($_POST['nombre']);
			$save = $categoria->save();
		}
		header("Location:" . base_url . "categoria/index");
	} */


	public function editar()
	{
		Utils::isAdmin();
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$edit = true;

			$categoria = new Categoria();
			$categoria->setId($id);

			$categoria = $categoria->getOne();

			require_once 'views/categoria/editarCategoria.php';
		} else {
			header('Location:' . base_url . 'Categoria/index.php');
		}
	}




	public function save()
	{
		Utils::isAdmin();
		if (isset($_POST)) {
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			
			
			// $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;

			if ($nombre ) {
				$categoria = new Categoria();
				$categoria->setNombre($nombre);
				
				
				

				if (isset($_GET['id'])) {
					$id = $_GET['id'];
					$categoria->setId($id);

					$save = $categoria->edit();
					var_dump($save); die();
				} else {
					$save = $categoria->save();
				}

				if ($save) {
					$_SESSION['categoria'] = "complete";
				} else {
					$_SESSION['categoria'] = "failed";
				}
			} else {
				$_SESSION['categoria'] = "failed";
			}
		} else {
			$_SESSION['categoria'] = "failed";
		}
		header('Location:' . base_url . 'categoria/index');
	}


	public function eliminar()
	{
		Utils::isAdmin();

		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$categoria = new Categoria();
			$categoria->setId($id);

			$delete = $categoria->delete();
			if ($delete) {
				
				$_SESSION['delete'] = 'complete';
			} else {
				$_SESSION['delete'] = 'failed';
			}
		} else {
			echo "<p>No se puede eliminar la categoría</p>";
			$_SESSION['delete'] = 'failed';
		}

		header('Location:' . base_url . 'producto/index');
	}

	
}
