


<?php


if(!isset($_POST['busqueda'])){
    header("Location: index.php");
}
?>
<h1>Busqueda: <?=$_POST['busqueda']?></h1>


 

<?php

/* $pro = $pro->conseguirProductos($_POST['busqueda']); */



 while($pro = $producto->fetch_object("Producto")): ?>
		
    <tr>
        <td><?=$pro->conseguirProductos($_POST['busqueda']);?></td>
       
    <?php endwhile; ?>
   
      
