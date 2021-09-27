<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piedra, papel, tijera</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@300&display=swap" rel="stylesheet">
    <style>
        
        .container{
            
                width: 80%;
                height: 80%;
    margin-left: auto;
    margin-right: auto;
    padding: 5%;
    border: 3px solid black;
    text-align: center;
    background-color: whitesmoke;
  
        }
        
    
        #encabezado > h1{
            font-family: 'Gemunu Libre', sans-serif;
            font-size: 70px;
color: #f9c700;
text-shadow: 0 0 4px #000;
        }
        
        .juego{
            font-family: 'Gemunu Libre', sans-serif;
            font-size: 55px;
        }
        .juego >h2{
            color: #4761e5;
        }
       
    </style>
</head>
<body>
    <div class="container">
    <?php
    define ('PIEDRA1',  "&#x1F91C;");
    define ('PIEDRA2',  "&#x1F91B;");
    define ('TIJERAS',  "&#x1F596;");
    define ('PAPEL',    "&#x1F91A;" );

 /* echo PIEDRA1;  */
$piedra1=PIEDRA1;
$piedra2=PIEDRA2;
$papel=PAPEL;
$tijeras=TIJERAS;

?>
<div id="encabezado">
<h1>PIEDRA,PAPEL,TIJERAS??<br><hr></h1>
</div>
<?php

    
    $jugador1=random_int(0,3);
    $jugador2=random_int(0,3);
?>

<div class="juego">
<?php
if ($jugador1 == 0 && $jugador2 == 1){
    echo "Jugador 1: ".$piedra1." Jugador 2: ".$piedra2."<br>";
    echo "<h2>Empate!</h2>";
    echo "<br><h3>Carga la página para seguir jugando!!</h3>";

}elseif($jugador1 == 1 && $jugador2 == 0){
    echo "Jugador 1: ".$piedra2." Jugador 2: ".$piedra1."<br>";
    echo "<h2>Empate!</h2>";
    echo "<br><h3>Carga la página para seguir jugando!!</h3>";

}elseif($jugador1 == 2 && $jugador2 == 2){
    echo "Jugador 1: ".$papel." Jugador 2: ".$papel."<br>";
    echo "<h2>Empate!</h2>";
    echo "<br><h3>Carga la página para seguir jugando!!</h3>";

}elseif($jugador1 == 3 && $jugador2 == 3){
    echo "Jugador 1: ".$tijeras." Jugador 2: ".$tijeras."<br>";
    echo "<h2>Empate!</h2>";
    echo "<br><h3>Carga la página para seguir jugando!!</h3>";

}elseif($jugador1 == 0 && $jugador2 == 3){
    echo "Jugador 1: ".$piedra1." Jugador 2: ".$papel."<br>";
    echo "<h2>GANA JUGADOR 2!!</h2>";
    echo "<br><h3>Carga la página para seguir jugando!!</h3>";

}elseif($jugador1 == 3 && $jugador2 == 0){
    echo "Jugador 1: ".$papel." Jugador 2: ".$piedra1."<br>";
    echo "<h2>GANA JUGADOR 1!!</h2>";
    echo "<br><h3>Carga la página para seguir jugando!!</h3>";

}elseif($jugador1 == 2 && $jugador2 == 1){
    echo "Jugador 1: ".$papel." Jugador 2: ".$piedra2."<br>";
    echo "<h2>GANA JUGADOR 1!!</h2>";
    echo "<br><h3>Carga la página para seguir jugando!!</h3>";

}elseif($jugador1 == 1 && $jugador2 == 2){
    echo "Jugador 1: ".$piedra2." Jugador 2: ".$papel."<br>";
    echo "<h2>GANA JUGADOR 2!!</h2>";
    echo "<br><h3>Carga la página para seguir jugando!!</h3>";

}elseif($jugador1 == 3 && $jugador1 == 2){
    echo "Jugador 1: ".$tijeras." Jugador 2: ".$papel."<br>";
    echo "<h2>GANA JUGADOR 1!!</h2>";
    echo "<br><h3>Carga la página para seguir jugando!!</h3>";

}elseif($jugador1 == 2 && $jugador1 == 3){
    echo "Jugador 1: ".$papel." Jugador 2: ".$tijeras."<br>";
    echo "<h2>GANA JUGADOR 2!!</h2>";
    echo "<br><h3>Carga la página para seguir jugando!!</h3>";

}elseif($jugador1 == 3 && $jugador2 == 1){
    echo "Jugador 1: ".$tijeras." Jugador 2: ".$piedra2."<br>";
    echo "<h2>GANA JUGADOR 2!!</h2>";
    echo "<br><h3>Carga la página para seguir jugando!!</h3>";

}elseif($jugador1 == 1 && $jugador2 == 3){
    echo "Jugador 1: ".$piedra2." Jugador 2: ".$tijeras."<br>";
    echo "<h2>GANA JUGADOR 1!!</h2>";
    echo "<br><h3>Carga la página para seguir jugando!!</h3>";

}elseif($jugador1 == 0 && $jugador2 == 0){
    echo "Jugador 1: ".$piedra1." Jugador 2: ".$piedra2."<br>";
    echo "<h2>Empate!!</h2>";
    echo "<br><h3>Carga la página para seguir jugando!!</h3>";

}else{
    header("Location: juego.php");
}
    ?>
    </div>
    </div>
    
</body>
</html>