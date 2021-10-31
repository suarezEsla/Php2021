<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Zen+Antique&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>
  <div class="container">
 <div class="formulario">
 <form action="compra.php" method="POST">



<select name="opciones" id="opciones">
    <option value="Limón">Limon</option>
    <option value="Naranjas">Naranjas</option>
    <option value="Manzanas">Manzanas</option>
    <input type="number" name="cantidad">
    <input type="submit" name="enviar" value="Enviar">
    <input type="button" value=" NUEVO CLIENTE "
       onclick="location.href='<?=$_SERVER['PHP_SELF'];?>'">
</select>


</form>



<?php
if(isset($_POST['enviar'])){
    session_start();
    $carrito = $_SESSION['carrito'][] = array();

    $producto = $_POST['opciones'];
    $cantidad = $_POST['cantidad'];

    array_push($carrito,$producto, $cantidad);
   
    if (!empty($_POST)){
        echo '<pre>';
?>
<div .formulario>
<table >
<tr>
<th >Opción</th>
<th>Cantidad</th>
</tr>

<tr>

<?php
foreach($carrito as $key => $value){
    echo '<td> '.$value.'</td> ';


echo '</pre>';
}     
    }      
}
 ?>
 
</tr>
</table>
<button><a href="login.php">Salir</a></button>
</div>

</body>

</html>