<?php

echo '<h1>2.- Crear un array que almacene 5 cadenas con el nombre de periódicos y sus enlaces para acceder. El array será asociativo con el nombre del periódico como clave y su URL como valor.Mostrar un lista html con cinco hiperenlaces a la URL de los diarios</h1>';


$periodicos = [
    "El País" => 'https://elpais.com/',
    "La Razón" => "https://www.larazon.es/",
    "El Mundo" => "https://www.elmundo.es/",
    "Marca" => "https://www.marca.com/",
    "OK Diario"=> "https://okdiario.com/"
    
];

/* foreach ($periodicos as $k => $v) {
    echo $k, $v;
} */



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista periódicos</title>
</head>
<body>
    <ul>
        <?php
        foreach ($periodicos as $k => $v) {

            
            echo '<li>'; 
            
            ?>

            <a href="<?php  echo $v;  ?>"><?php echo $v;?></a>
            <?php
            echo'</li>';
       
        }
        
        ?>
        </ul>


<hr>
        <h3>3. Elegir a azar uno de los cinco medios y  mostrar el enlace seleccionado.</h3>
    <?php

  function seleccionAleatoria($array){
    $aleatorio = array_rand($array,1);
    return $aleatorio;
  }

  $seleccion = seleccionAleatoria($periodicos);
       
       
    echo '<h4>El periódico del día es: '.$seleccion.'</h4>';
    
    
    
    ?>
</body>
</html>