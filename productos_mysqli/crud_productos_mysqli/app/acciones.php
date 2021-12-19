<?php
include_once "Producto.php";

function accionBorrar ($producto_no){    
    $db = AccesoDatos::getModelo();
     $db->borrarProducto($producto_no);
}

function accionTerminar(){
    AccesoDatos::closeModelo();
    session_destroy();
}
 
function accionAlta(){
    $producto = new Producto();
    $producto->producto_no  = "";
    $producto->descripcion   = "";
    $producto->precio_actual   = "";
    $producto->stock_disponible = "";
    $orden= "Nuevo";
    include_once "layout/formulario.php";
}

function accionDetalles($producto_no){
    $db = AccesoDatos::getModelo();
    $producto = $db->getProducto($producto_no);
    $orden = "Detalles";
    include_once "layout/formulario.php";
}


function accionModificar($producto_no){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    

    $db = AccesoDatos::getModelo();//Accede al modelo
    $producto = $db->getProducto($producto_no);//Obtiene el producto a modificar con el id 

    $db->modProducto($producto);//Llama a modProducto con el producto que se ha obtenido en la bd
    $orden="Modificar";
    include_once "layout/formulario.php";
}

function accionPostAlta(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $producto = new Producto();
    $producto->producto_no  = $_POST['producto_no'];
    $producto->descripcion   = $_POST['descripcion'];
    $producto->precio_actual   = $_POST['precio_actual'];
    $producto->stock_disponible = $_POST['stock_disponible'];
    $db = AccesoDatos::getModelo();
    $db->addProducto($producto);
    
}

function accionPostModificar(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $producto = new Producto();
    $producto->producto_no  = $_POST['producto_no'];
    $producto->descripcion  = $_POST['descripcion'];
    $producto->precio_actual  = $_POST['precio_actual'];
    $producto->stock_disponible = $_POST['stock_disponible'];
    $db = AccesoDatos::getModelo();
    $db->modProducto($producto);
    
}



