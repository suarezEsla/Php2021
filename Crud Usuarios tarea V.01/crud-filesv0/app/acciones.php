<?php



function accionDetalles($id){
    $usuario = $_SESSION['tuser'][$id];
    $nombre  = $usuario[0];
    $login   = $usuario[1];
    $clave   = $usuario[2];
    $comentario=$usuario[3];
    $orden = "Detalles";
    include_once "layout/formulario.php";
    exit();
}

function accionAlta(){
    $nombre  = "";
    $login   = "";
    $clave   = "";
    $comentario = "";
    $orden= "Nuevo";
    include_once "layout/formulario.php";
    exit();
}

function accionPostAlta(){
 
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código

    //Se leen los datos del formulario, y se incluyen en el array tuser
    $nuevo = [ $_POST['nombre'],$_POST['login'],$_POST['clave'],$_POST['comentario']];
    $_SESSION['tuser'][]= $nuevo;  
}

function accionPostModificar(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $i=0;
    foreach ($_SESSION['tuser'] as $usuario){
        if ($usuario[1] == $_POST['login']){
            $usuario[0]= $_POST['nombre'];
            $usuario[2]= $_POST['clave'];
            $usuario[3]= $_POST['comentario'];
            $_SESSION['tuser'][$i] = $usuario;
            break;
        }
        $i++;
    }
    
}

//Se hace la función pasándole el parámetro id
function accionBorrar ($id){ 
    //Se destruye la sesión creada en el index   
    unset($_SESSION['tuser'][$id]); 
    //Se carga el array con los valores que no se hayan destruido
    $_SESSION['tuser'] = array_values($_SESSION['tuser']);
}

//Se hace la función pasándole el parámetro id
function accionModificar($id){
    //Se crea la variable usuario con los valores del array y el id y se asignan valores segun el indice
    $usuario = $_SESSION['tuser'][$id];
    $nombre  = $usuario[0];
    $login   = $usuario[1];
    $clave   = $usuario[2];
    $comentario=$usuario[3];
    $orden="Modificar";
    include_once "layout/formulario.php";
}

function accionTerminar(){
    volcarDatos($_SESSION['tuser']);
    session_destroy();
}
