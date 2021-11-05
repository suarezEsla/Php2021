<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Noviembre Palabra Secreta</title>
</head>
<body>
    <!--Formulario de introducción de letras-->
    <form action="#">
        <label for="letra">
        Introduce una letra para adivinar la palabra <br>
        </label>
        <input type="text" name="letra">
    </form>


<?php
//Se inicia sesión y se declara un máximo de 6 fallos posibles
session_start();
define('MAXFALLOS', 6);
include_once 'funciones.php';


//Nueva partida, se elige una palabra de entre las que hay en el array de la función elegirPalabra()

if (! isset($_SESSION['palabrasecreta'])) {
    //Si no existe, se genera
    $_SESSION['palabrasecreta'] = elegirPalabra();
    $_SESSION['letrasusuario'] = "";
    $_SESSION['fallos'] = 0;

    echo '<h4>Nueva partida</h4></br>';
}




//Si se ha incluido una letra, se añade a la variable $letra
if (isset($_REQUEST['letra'])) {

    $letra =  $_REQUEST['letra'];

    //Si la 
    if (comprobarLetra($letra, $_SESSION['palabrasecreta']) == false) {

        $_SESSION['fallos'] ++;
        echo "Llevas ".$_SESSION['fallos']. " fallos";
        //Si se alcanza o supera el maximo de fallos se termina y se destruye la sesión
        if ($_SESSION['fallos'] >= MAXFALLOS) {
            echo " Superado el máximo número de fallos. Has perdido <br> ";
            session_destroy();

            //Se vuelve al self
            echo "<a href=\"" . $_SERVER['PHP_SELF'] . "\"> Otra partida </a> </body></html>";
            exit();
        }
    } else {
        // Anoto la letra como correcta
        $_SESSION['letrasusuario'] .= $letra;
    }
}


$palabramostrar = generaPalabraconHuecos($_SESSION['letrasusuario'], $_SESSION['palabrasecreta']);
echo " Palabra :  $palabramostrar </br> ";
if ($palabramostrar == $_SESSION['palabrasecreta']) {
    $ganadas++;
    echo " Enhorabuena has ganado. Ya son $ganadas partidas ganadas.<br>";
}

?>



</body>
</html>