<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>
<body>
    


<?php
echo '<h1>5.  Realizar un programa en PHP que muestre un posible resultado de la bonoloto:
Se presentarán 6 números obtenidos aleatoriamente en el rango de 1 a 49 (ambos inclusives). Los 5 primeros forman la jugada ganadora y deberán presentar ordenados de menor a mayor en una tabla html; el sexto es el número complementario.  Por supuesto los números no pueden repetirse.</h1>';

define('TAMANO',20);

//Sacar 6 números aleatorios e insertarlos en el array 'arrray' y mostrar los 5 primeros en una tabla
function numeros($tamano){
    $array = [];
    for ($i=0; $i < 6; $i++) { 

        $nums = rand(1,49);
        
        array_push($array,$nums);


        $cinco = array_slice($array,0,5);
        $sexto = array_slice($array,5,6);


        
}

    echo "<table style='border: 2px solid violet; border-collapse:collapse';>";
    echo "<h2>Números ganadores, ordenados de menor a mayor: </h2><br>";
    echo '<th colspan="5">Números ganadores</th>';
echo "<tr>";
    for ($i = 0; $i<count($cinco);$i++) {
        sort($cinco);
        echo "<td style='border: 1px solid violet; padding: 5px';>",$cinco[$i]."</td>";
    }
    echo "</tr>";
    echo '<th colspan="5">Complementario</th>';
    echo "<tr>";
    for ($i = 0; $i<count($sexto);$i++) {
        
        echo "<td style='border: 1px solid violet; padding: 5px';>",$sexto[$i]."</td>";
    }
    echo "</tr></table>";
    


return $cinco;
}




$numeros = numeros(TAMANO);


  

/* echo '<hr>';

show_source(__FILE__);  */
?>


</body>
</html>