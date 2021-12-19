<?php
include_once "Producto.php";
include_once "config.php";

/*
 * Acceso a datos con BD Usuarios : 
 * Usando la librería mysqli
 * Uso el Patrón Singleton :Un único objeto para la clase
 * Constructor privado, y métodos estáticos 
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    
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


    // SELECT Devuelvo la lista de Usuarios
    public function getProductos():array {
        $tuser = [];
        // Crea la sentencia preparada
        $stmt_productos  = $this->dbh->prepare("select * from productos");
        // Si falla termian el programa
        if ( $stmt_productos == false) die (__FILE__.':'.__LINE__.$this->dbh->error);
        // Ejecuto la sentencia
        $stmt_productos->execute();
        
        // Obtengo los resultados
        $result = $stmt_productos->get_result();
        // Si hay resultado correctos
        if ( $result ){
            // Obtengo cada fila de la respuesta como un objeto de tipo Usuario
            while ( $producto = $result->fetch_object('Producto')){
               $tuser[]= $producto;
            }
        }
        // Devuelvo el array de objetos
        return $tuser;
    }
    
    // SELECT Devuelvo un usuario o false
    public function getProducto ($producto_no) {
        $producto = false;
        
        $stmt_producto   = $this->dbh->prepare("select * from productos where producto_no =?");
        if( $stmt_producto == false){
            die ($this->dbh->error);
        } 

        // Enlazo $stock_disponible con el primer ? 
        $stmt_producto->bind_param("s",$producto_no);
        $stmt_producto->execute();
        $result = $stmt_producto->get_result();
        if ( $result ){
            $producto = $result->fetch_object('Producto');
            }
        
        return $producto;
    }
    
    // UPDATE
    public function modProducto($producto):bool{
      
        $stmt_modproducto  = $this->dbh->prepare("update productos set descripcion=?, precio_actual=?, stock_disponible=? where producto_no=?");
        if ( $stmt_modproducto == false) {
            die ($this->dbh->error);
        }

        $stmt_modproducto->bind_param("sii", $producto->producto, $producto->precio_actual, $producto->stock_disponible);
        $stmt_modproducto->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }
    

    //INSERT
     public function addProducto($producto):bool{
       
       $stmt_creaproducto  = $this->dbh->prepare("insert into productos (producto_no, descripcion , precio_actual,stock_disponible) Values(?,?,?,?)");
        if ($stmt_creaproducto == false) die ($this->dbh->error);

        $stmt_creaproducto->bind_param("ssss",$producto->producto_no, $producto->descripcion, $producto->precio_actual, $producto->stock_disponible);
       $stmt_creaproducto->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    } 

    //DELETE
    public function borrarProducto(String $producto_no):bool {
        $stmt_borproducto  = $this->dbh->prepare("delete from productos where producto_no =?");
        if ( $stmt_borproducto== false){
            die ($this->dbh->error);
        } 
       
        $stmt_borproducto->bind_param("s", $producto_no);
        $stmt_borproducto->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }   
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}
