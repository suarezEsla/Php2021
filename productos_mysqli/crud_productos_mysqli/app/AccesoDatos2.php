<?php
include_once "Producto.php";
include_once "config.php";

/*
 * Acceso a datos con BD productos : 
 * Usando la librería mysqli
 * Uso el Patrón Singleton :Un único objeto para la clase
 * Constructor privado, y métodos estáticos 
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    private $stmt_productos = null;
    private $stmt_producto  = null;
    private $stmt_borproducto  = null;
    private $stmt_modproducto  = null;
    private $stmt_creaproducto = null;
    
    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    

   // Constructor privado  Patron singleton
   
    private function __construct(){
        
       
         $this->dbh = new mysqli(DB_SERVER,DB_USER,DB_PASSWD,DATABASE);
         
      if ( $this->dbh->connect_error){
         die(" Error en la conexión ".$this->dbh->connect_errno);
        } 

        // Construyo las consultas previamente

        $this->stmt_productos  = $this->dbh->prepare("select * from productos");
        if ( $this->stmt_productos == false) die (__FILE__.':'.__LINE__.$this->dbh->error);

        $this->stmt_producto   = $this->dbh->prepare("select * from productos where producto_no =?");
        if ( $this->stmt_producto == false) die ($this->dbh->error);

        $this->stmt_borproducto   = $this->dbh->prepare("delete from productos where producto_no =?");
        if ( $this->stmt_borproducto == false) die ($this->dbh->error);

        $this->stmt_modproducto   = $this->dbh->prepare("update productos set descripcion=?, precio_actual=?, stock_disponible=? where producto_no=?");
        if ( $this->stmt_modproducto == false) die ($this->dbh->error);

        $this->stmt_creaproducto  = $this->dbh->prepare("insert into productos (producto_no, descripcion, precio_actual, stock_disponible) Values(?,?,?,?)");
        if ( $this->stmt_creaproducto == false) die ($this->dbh->error);
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            // Cierro la base de datos
            $obj->dbh->close();
            self::$modelo = null; // Borro el objeto.
        }
    }


    // SELECT Devuelvo la lista de productos
    public function getproductos ():array {
        $tuser = [];
        
        $this->stmt_productos->execute();

        $result = $this->stmt_productos->get_result();
        if ( $result ){
            while ( $producto = $result->fetch_object('Producto')){
               $tuser[]= $producto;
            }
        }
        return $tuser;
    }
    
    // SELECT Devuelvo un usuario o false
    public function getProducto (String $producto_no) {
        $producto = false;
        
        $this->stmt_producto->bind_param("s",$producto_no);
        $this->stmt_producto->execute();
        $result = $this->stmt_producto->get_result();
        if ( $result ){
            $producto = $result->fetch_object('Producto');
            }
        
        return $producto;
    }
    
    // UPDATE
    public function modProducto($producto):bool{
      
    
        $this->stmt_moduser->bind_param("ssss",
        $producto->producto_no,$producto->descripcion, $producto->precio_actual, $producto->stock_disponible);
        $this->stmt_moduser->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }

    //INSERT
    public function addProducto($producto):bool{
       
        $this->stmt_creaproducto->bind_param("ssss",$producto->producto_no, $producto->descripcion, $producto->precio_actual, $producto->stock_disponible);
        $this->stmt_creaproducto->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }

    //DELETE
    public function borrarUsuario(String $producto_no):bool {
        $this->stmt_boruser->bind_param("s", $producto_no);
        $this->stmt_boruser->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }   
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}
