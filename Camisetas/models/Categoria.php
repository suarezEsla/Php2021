<?php

class Categoria
{
	public $id;
	public $nombre;
	private $db;

	public function __construct()
	{
		$this->db = Database::connect();
	}

	function getId()
	{
		return $this->id;
	}

	function getNombre()
	{
		return $this->nombre;
	}

	function setId($id)
	{
		$this->id = $id;
	}

	function setNombre($nombre)
	{
		$this->nombre = $this->db->real_escape_string($nombre);
	}



	//Función para bajar el precio de los productos en oferta
	function precioOferta($precios)
	{
		$precios = $this->db->query("UPDATE producto SET precio = ROUND( precio * 1.20, 2 )");
		$precioRebajado = $this->db->query($precios);
	}


	//Función para sacar el dinero generado por cada categoría
	public function generadoPorCategoria()
	{
		$sql = $this->db->prepare("SELECT sum(p.precio * l.unidades) FROM lineas_pedidos l, productos p WHERE p.id=l.producto_id AND categoria_id=?");

		$sql->bind_param("i", $this->id);
		$sql->execute();
		$generado = $sql->get_result();
		$generado = $generado->fetch_array(MYSQLI_NUM)[0];
		return number_format($generado, 2, ",");
	}

	public function stockCategoria(){
		$sql = $this->db->prepare("select p.stock, p.nombre from productos p join categorias c on c.id=p.categoria_id where c.id=?;");

		$sql->bind_param("i", $this->id);
		$sql->execute();
		$generado = $sql->get_result();
		$generado = $generado->fetch_array(MYSQLI_NUM)[0];
		return number_format($generado, 2, ",");
	}


	public function edit()
	{
		$sql = "UPDATE categorias SET nombre='{$this->getNombre()}' ";
		$sql .= " WHERE id={$this->getId()};";

		

		$save = $this->db->query($sql);

		$result = false;
		if ($save) {
			$result = true;
		}
		return $result;
	}


	public function delete()
	{
/* 
		$consulta1 = "SELECT * FROM productos WHERE categoria_id={$this->id}";
		$consultar = $this->db->query($consulta1);

		if ($consultar) { */

			/* echo "Error, no se puede borrar una categoría con productos.";

		} else { */

			$sql = "DELETE FROM categorias WHERE id={$this->id}";
			$delete = $this->db->query($sql);

			$result = false;
			if ($delete) {
				$result = true;
			}
		/* } */

		return $result;
	}



	public function getAll()
	{
		$categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");
		return $categorias;
	}

	public function getOne()
	{
		$categoria = $this->db->query("SELECT * FROM categorias WHERE id={$this->getId()}");
		return $categoria->fetch_object();
	}

	public function save()
	{
		$sql = "INSERT INTO categorias VALUES(NULL, '{$this->getNombre()}');";
		$save = $this->db->query($sql);

		$result = false;
		if ($save) {
			$result = true;
		}
		return $result;
	}
}
