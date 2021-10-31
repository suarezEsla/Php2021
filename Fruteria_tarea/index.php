<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    

<?php
/*Página principal, el formulario funciona a través de 'orden'. El switch redirige a las diferentes opciones que tenemos:
    1.- Entrar, que nos lleva al formulario de compra, dentro del cual efectuamos la compra y nos da la opcion:
    a.-Nuevo cliente, que cierra sesión y nos redirige al login.php
*/
if(!isset($_REQUEST['orden'])){
    include_once './login.php';

}else{
    switch ($_REQUEST['orden']){
        case 'Entrar':
            if(isset($_REQUEST['nombre']) && $_REQUEST['nombre'] !== ""){
                session_start();
                //Declaración de sesión de nombre
                    $_SESSION['nombre'] = $_REQUEST['nombre'];
// Establecer tiempo de vida de la sesión en segundos
    $inactividad = 600;
    // Comprobar si $_SESSION["timeout"] está establecida
    if(isset($_SESSION["timeout"])){
        // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
        $sessionTTL = time() - $_SESSION["timeout"];
        if($sessionTTL > $inactividad){
            session_destroy();
            header("Location: /logout.php");
        }
    }
    // El siguiente key se crea cuando se inicia sesión
    $_SESSION["timeout"] = time();



                    echo "<div class='container' ><h2>Bienvenido/a ".$_SESSION['nombre'].", qué quieres comprar hoy?</h2></div></br>";
                   
                   
                    include_once './compra.php';
            }else {

                echo "<div class='container' ><h2>No hay ninguna sesión iniciada!.</h2></div>";
                
                include_once './login.php';
            }
            break;
            case 'Anotar':
                include_once './compra.php';
         default:        
    }
}
?>

</body>
</html>