<html>
<head>
<meta charset="UTF-8">
<link href="web/default.css" rel="stylesheet" type="text/css" />
<title>MINIFORO</title>
</head>
<body>
<div id="container" style="width: 450px;">
<div id="header">
<!-- <img src="https://images.unsplash.com/photo-1560109947-543149eceb16?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=435&q=80" alt="mini foro logo" width="100px" height="100px"> -->
<h1>MINIFORO versión 1.0</h1>
</div>

<div id="content">

<?php 
// PRIMERA APROXIMACIÓN AL MODELO VISTA CONTROLADOR. 
// Funciones auxiliars Ej- usuarioOK
include_once 'app/funciones.php';

if ( !isset($_REQUEST['orden']) ){
    include_once 'app/entrada.php';
} 
else {
    switch ($_REQUEST['orden']){
        
        case "Entrar":
            // Chequear usuario, si el usuario es correcto nos lleva a comentario.html
            if ( isset($_REQUEST['nombre']) && isset($_REQUEST['contraseña']) && 

            //llamada a función de chequeo de nombre y contraseña
                 usuarioOK($_REQUEST['nombre'], $_REQUEST['contraseña'] )) {
                     //Creamos sesión con el nombre 
                     session_start();
                    $_SESSION['nombre'] = $_REQUEST['nombre'];

                    echo "Bienvenido! Has iniciado sesion como:<b> ".$_REQUEST['nombre']."</b>";

                   

                  

            //Redirecciona a comentario.html, con las 3 opciones disponibles, Nueva opinión, detalles o terminar
               include_once  'app/comentario.html';
               
            }
            else {
                //Si el usuario no es correcto, nos devuelve al formulario de entrada de nuevo
                echo " <br> Acceso restringido </br>";
                include_once 'app/entrada.php';
                
            }
            break;


            //HAY 3 OPCIONES: DETALLES, NUEVA OPINIÓN O TERMINAR
           
        case "Nueva opinión":
            echo "<h4>Seleccione una de las siguientes opciones: <br>";
            include_once  'app/comentario.html';
            break;

        case "Detalles": // Mensaje y detalles
            echo "Detalles de su opinión";
            include_once 'app/comentariorelleno.php';
            include_once 'app/detalles.php';
            break;
            
        case "Terminar": // Formulario inicial
            include_once 'app/entrada.php';
            break;

            case "Cerrar Sesión": // Cierre de sesión
                include_once 'app/CerrarSesion.php';
                break;

    }
    
}

?>
</div>
</div>
</body>
</html>

