
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Ejercicio 4</title>
   
</head>
<style>
        img{
            width: 200px;
        }
    </style>
<body>
    





<?php
echo '<h1>4. Crear una carpeta que se llame img y copiar en ella 5 ficheros de imágenes que muestre el logo de un deporte. Crear una array asociativo que almacene como clave el nombre del deporte y como valor la dirección de la imagen. Mostrar en una tabla como la del enunciado.</h1>';

$deportes = [
    "Karate" => "../Ejercicios3_array/img/Karate.jpeg",
    "Fútbol" => "../Ejercicios3_array/img/futbol.jpg",
    "Natación" => "../Ejercicios3_array/img/natacion.jpg"
];

foreach ($deportes as $key => $value) {

    ?>
<table border="1px solid black">
<tr>
    <th>Deporte</th>
    <th>Imágen</th>
</tr>
    <tr>
        <td>
            <?php echo $key; ?>
        </td>  
        <td>
        <img src=" <?php echo $value; ?> " alt="imagen">
</td>
</tr>

       
    

</table>
       
    <?php
}

?>


</body>
</html>