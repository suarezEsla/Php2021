<?php

class Producto{
	public $id;
	private $categoria_id;
	public $nombre;
	private $descripcion;
	public $precio;
	public $stock;
	private $oferta;
	private $fecha;
	private $imagen;

	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	function getId() {
		return $this->id;
	}

	function getCategoria_id() {
		return $this->categoria_id;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getDescripcion() {
		return $this->descripcion;
	}

	function getPrecio() {
		return $this->precio;
	}

	function getStock() {
		return $this->stock;
	}

	function getOferta() {
		return $this->oferta;
	}

	function getFecha() {
		return $this->fecha;
	}

	function getImagen() {
		return $this->imagen;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setCategoria_id($categoria_id) {
		$this->categoria_id = $categoria_id;
	}

	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	function setDescripcion($descripcion) {
		$this->descripcion = $this->db->real_escape_string($descripcion);
	}

	function setPrecio($precio) {
		$this->precio = $this->db->real_escape_string($precio);
	}

	function setStock($stock) {
		$this->stock = $this->db->real_escape_string($stock);
	}

	function setOferta($oferta) {
		$this->oferta = $this->db->real_escape_string($oferta);
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	function setImagen($imagen) {
		$this->imagen = $imagen;
	}

//Función para obtener las ofertas de la bd
public function obtenerOfertas(){
	$categorias = $this->db->query("SELECT * FROM productos WHERE oferta='si' ORDER BY precio " );
		return $categorias;
}



	
	public function getAll(){
		$productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC");

		/* if($this->getOferta() ){
			$productos .= "WHERE oferta = 'si'";
		} */
		return $productos;
	}



	//Función para obtener el total de productos vendidos
	public function obtenerTotalProductosVendidos(){
		$idProducto = $this->id;
		$totaLVentas = $this->db->prepare("SELECT sum(unidades) as 'total' FROM lineas_pedidos WHERE producto_id =?");
		

		$totaLVentas->bind_param("i",$idProducto);
		$totaLVentas->execute();

		$total = $totaLVentas->get_result()->fetch_array()[0];

		
		return $total;
		
	}

//Función para sacar el producto más vendido
	public function obtenerMasVendido(){
		
		$masVendido = "SELECT max(l.producto_id), p.nombre FROM lineas_pedidos l join productos p where l.producto_id=p.id";
		
		

		$productos = $this->db->query($masVendido);
		return $productos;
	}
 


	
	public function getAllCategory(){
		$sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
				. "INNER JOIN categorias c ON c.id = p.categoria_id "
				. "WHERE p.categoria_id = {$this->getCategoria_id()} "
				. "ORDER BY id DESC";
		$productos = $this->db->query($sql);
		return $productos;
	}
	





	public function getRandom($limit){
		$productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");
		return $productos;
	}
	
	public function getOne(){
		$producto = $this->db->query("SELECT * FROM productos WHERE id = {$this->getId()}");
		return $producto->fetch_object();
	}
	
	public function save(){
		$sql = "INSERT INTO productos VALUES(NULL, {$this->getCategoria_id()}, '{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()}, null, CURDATE(), '{$this->getImagen()}');";
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function edit(){
		$sql = "UPDATE productos SET nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio={$this->getPrecio()}, stock={$this->getStock()}, categoria_id={$this->getCategoria_id()}";
		
		if($this->getImagen() != null){
			$sql .= ", imagen='{$this->getImagen()}'";
		}
		
		$sql .= " WHERE id={$this->id};";
		
		
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function delete(){
		$sql = "DELETE FROM productos WHERE id={$this->id}";
		$delete = $this->db->query($sql);
		
		$result = false;
		if($delete){
			$result = true;
		}
		return $result;
	}
	


	public function conseguirProductos( $busqueda = null){
		$sql="SELECT p.nombre AS 'producto' FROM productos p ";
			 
		$producto = $this->db->query($sql);
	
		if($producto && $producto->num_rows == 1){
			$resultado = $producto->fetch_object();
				$result = $resultado;	
		}


		if(!empty($busqueda)){
			$sql .= "WHERE p.nombre LIKE '%$busqueda%' ";
		}
		
		$sql .= "ORDER BY e.id DESC ";
	
		return $result;
	}
}