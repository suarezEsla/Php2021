<?php
echo '<h3>1.- Rellenar un array con 20 números aleatorios entre 1 y 10 y mostrar el contenido del array  mediante una tabla de una fila en HMTL. Mostrar a continuación el valor máximo, el mínimo y el  valor que mas veces se repite. (Nota definir funciones para cada caso)</h3>';




//Crear array y rellenarlo con números aleatorios

function rellenarArray($tamaño){
    $arrayVacio =[];
    for ($i = 0; $i < $tamaño; $i++) {
     $arrayVacio[] = rand (1,10);
    }
    return $arrayVacio;
}

//Definir el tamaño
define('TAMANO',20);


//Llamar a función con tamaño definido anteriormente
$aleatorios = rellenarArray(TAMANO);


echo "<table style='border: 2px solid violet; border-collapse:collapse';><tr>";

for ($i = 0; $i<count($aleatorios);$i++) {
    echo "<td style='border: 1px solid violet; padding: 5px';>",$aleatorios[$i]."</td>";
}
echo "</tr></table>";

function maximo($aleatorios){
    $numMax = max($aleatorios);
     echo $numMax;
    

}

function minimo ($aleatorios){
    $numMin = min($aleatorios);
    echo $numMin;
}

echo '<h3>Máximo: </h3><br>';
maximo($aleatorios);
echo '<h3>Mínimo: </h3><br>';
minimo($aleatorios);

echo '<hr>';
 show_source(__FILE__); 
?>



