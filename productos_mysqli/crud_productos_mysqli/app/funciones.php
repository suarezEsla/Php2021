<?php
include_once 'app/config.php';
include_once 'app/AccesoDatos.php';



// MUESTRA TODOS LOS USUARIOS
function mostrarDatos(){
    
    $titulos = [ "Producto_No","Descripción","Precio_actual","Stock_Dispo"];
    $msg = "<table>\n";
     // Identificador de la tabla
    $msg .= "<tr>";
    for ($j=0; $j < count($titulos); $j++){
        $msg .= "<th>$titulos[$j]</th>";
    }  
    $msg .= "</tr>";
    $auto = $_SERVER['PHP_SELF'];
    $db = AccesoDatos::getModelo();
    $tproducto = $db->getProductos();
    foreach ($tproducto as $producto) {
        $msg .= "<tr>";
        $msg .= "<td>$producto->producto_no</td>";
        $msg .= "<td>$producto->descripcion</td>";
        $msg .= "<td>$producto->precio_actual</td>";
        $msg .= "<td>$producto->stock_disponible</td>";
        $msg .="<td><a href=\"".$auto."?orden=Borrar&producto_no=$producto->producto_no\">Borrar</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Modificar&producto_no=$producto->producto_no\">Modificar</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Detalles&producto_no=$producto->producto_no\" >Detalles</a></td>\n";
        $msg .="</tr>\n";
        
    }
    $msg .= "</table>";
   
    return $msg;    
}

/*
 *  Funciones para limpiar la entreda de posibles inyecciones
 */

function limpiarEntrada(string $entrada):string{
    $salida = trim($entrada); // Elimina espacios antes y después de los datos
    $salida = strip_tags($salida); // Elimina marcas
    return $salida;
}
// Función para limpiar todos elementos de un array
function limpiarArrayEntrada(array &$entrada){
 
    foreach ($entrada as $key => $value ) {
        $entrada[$key] = limpiarEntrada($value);
    }
}

