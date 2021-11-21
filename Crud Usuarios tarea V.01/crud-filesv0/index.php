<?php
session_start();

include_once 'app/funciones.php';
include_once 'app/acciones.php';

// Tabla de usuarios, si no existe la sesión, la creamos y llamamos a cargarDatos que es quien recoge los datos del TXT
if (!isset ($_SESSION['tuser'])){
    $_SESSION['tuser'] = cargarDatos();  
}

// Div con contenido (Si existe orden en principal.php, llama a funciones)
$contenido="";
if ($_SERVER['REQUEST_METHOD'] == "GET" ){
    
    if ( isset($_GET['orden'])){
        switch ($_GET['orden']) {
            case "Nuevo"    : accionAlta(); break;//Se llama a las funciones con el parámetro get id
            case "Borrar"   : accionBorrar   ($_GET['id']); break;
            case "Modificar": accionModificar($_GET['id']); break;
            case "Detalles" : accionDetalles ($_GET['id']);break;
            case "Terminar" : accionTerminar(); break;
        }
    }
} 
// POST Formulario de alta o de modificación (formulario.php)
else {
    if (  isset($_POST['orden'])){
         switch($_POST['orden']) {
             case "Nuevo"    : accionPostAlta(); break;
             case "Modificar": accionPostModificar(); break;
             case "Detalles":; // No hago nada
         }
    }
}

//llama a mostrarDatos
$contenido .= mostrarDatos();
// Muestro la página principal
include_once "app/layout/principal.php";




