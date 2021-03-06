<?php

class Usuario{
	public $id;
	public $nombre;
	public $apellidos;
	public $email;
	private $password;
	private $rol;
	private $imagen;
	public $direccion;
	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	
	function getId() {
		return $this->id;
	}
	
	function getDireccion(){
		return $this->direccion;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getApellidos() {
		return $this->apellidos;
	}

	function getEmail() {
		return $this->email;
	}

	function getPassword() {
		return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
	}

	function getRol() {
		return $this->rol;
	}

	function getImagen() {
		return $this->imagen;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	function setApellidos($apellidos) {
		$this->apellidos = $this->db->real_escape_string($apellidos);
	}

	function setEmail($email) {
		$this->email = $this->db->real_escape_string($email);
	}

	function setPassword($password) {
		$this->password = $password;
	}
	function  setDireccion($direccion){
		$this->direccion = $direccion;
	}

	function setRol($rol) {
		$this->rol = $rol;
	}

	function setImagen($imagen) {
		$this->imagen = $imagen;
	}


	/* public function consultaDireccion($usuario){
		$direccionSeleccionada = $this->db->query("SELECT direccion_habitual FROM usuarios where id=$usuario");
		
	
		return $direccionSeleccionada->fetch_object();
	} */
	


public function importeTotal(){
	$idUsuario = $this->id;
	$totalVendido = $this->db->prepare("select sum(pe.coste) from pedidos pe join usuarios u on pe.usuario_id=?");
	
	

	$totalVendido->bind_param("i",$idUsuario);
	$totalVendido->execute();

	$total = $totalVendido->get_result()->fetch_array()[0];

	
	return $total;
	
}


	public function save(){
		$sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getDireccion()}', '{$this->getPassword()}', 'user', null); ";
/* var_dump($sql); die(); */

		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}


	public function verPedidos(){
			$email = $this->email;
		$result = false;
		// Comprobar si existe el usuario
		$sql = "SELECT * FROM pedidos where email = '$email' ORDER BY id DESC";
		$pedidos = $this->db->query($sql);
		
		
		if($pedidos && $pedidos->num_rows == 1){
			$usuario = $pedidos->fetch_object();
				$result = $usuario;	
		}
		
		return $result;
		
	}
	


	
	public function login(){
		$result = false;
		$email = $this->email;
		$password = $this->password;
		
		// Comprobar si existe el usuario
		$sql = "SELECT * FROM usuarios WHERE email = '$email'";
		$login = $this->db->query($sql);
		
		
		if($login && $login->num_rows == 1){
			$usuario = $login->fetch_object();
			
			// Verificar la contrase??a
			$verify = password_verify($password, $usuario->password);
			
			if($verify){
				$result = $usuario;
			}
		}
		
		return $result;
	}


	//Esla
	public function edit(){
	$sql = "UPDATE usuarios SET nombre='{$this->getNombre()}', apellidos='{$this->getApellidos()}', email='{$this->getEmail()}' , direccion='{$this->getDireccion()}', password='{$this->getPassword()}', rol='user', imagen=NULL WHERE id='{$this->id}'"; 
		/* var_dump($sql);
		die; */
		
		/* $sql .= " WHERE id='{$this->id}';"; */
		
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}




	public function obtenerUnUsuario(int $userId):Usuario{

		$user = $this->db->query("SELECT * FROM usuarios WHERE id = $userId");

		$user = $user->fetch_object("Usuario");
		if ($user == null){
			header("Location:".base_url);
			die();
		}
		return $user;

	}




	public static function usuarioSinPedidos(){
		$user = $this->db->query("SELECT DISTINCT usuario_id FROM pedidos");
		
		return $user;
	}

	public function getAllUsers(){

		$usersArray = [];
		$users      = $this->db->query("SELECT * FROM usuarios ORDER BY rol, id DESC");
		while($row = $users->fetch_object("Usuario"))$usersArray[] = $row;


		return $usersArray;
	}




	public function delete(){
		$sql = "DELETE FROM usuarios WHERE id={$this->id}";
		$delete = $this->db->query($sql);
		
		$result = false;
		if($delete){
			$result = true;
		}
		return $result;
	}

	//Esla
	public function getAll(){
		$usuarios = $this->db->query("SELECT * FROM usuarios ORDER BY id DESC");
		return $usuarios;
	}
	
	//Esla
	public function getOne(){
		$user = $this->db->query("SELECT * FROM usuarios WHERE id = {$this->getId()}");
		return $user->fetch_object();
	}


	public function getMisDatos(){
		$sql = "SELECT * FROM usuarios "
				. "WHERE id = {$this->getId()} ORDER BY id DESC";
			
		$usuario = $this->db->query($sql);
			
		return $usuario->fetch_object();
	}



//Funci??n para obtener todos los usuarios en un array
	public function todosUsuarios(){

		$arrayUsuarios = [];
		$usuarios = $this->db->query("SELECT * FROM usuarios order by id DESC");
		while($fila = $usuarios->fetch_object("Usuario"))$arrayUsuarios[] = $fila;


		return $arrayUsuarios;
	}
	

//Funci??n para obtener un ??nico usuario por id
	public function unUsuario(int $userId):Usuario{

		$usuario = $this->db->query("SELECT * FROM usuarios WHERE id = $userId");

		$usuario = $usuario->fetch_object("Usuario");



		if ($usuario == null){

			header("Location:".base_url);
			
		}
		return $usuario;

	}
}