<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CRUD DE USUARIOS</title>
<link href="web/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container" style="width: 600px;">
<div id="header">
<h1>GESTIÓN DE USUARIOS versión 1.1 + BD</h1>
</div>
<div id="content">
<hr>
<form   method="POST">
<table>
 <tr><td>Producto_no </td> 
 <td>
 <input type="text" 	name="producto_no" 	value="<?=$producto->producto_no ?>"  <?= ($orden == "Detalles")?"readonly":"" ?> size="20" autofocus></td></tr>
 <tr><td>Descripcion  </td> <td>
 <input type="text" 	name="descripcion" 	value="<?=$producto->descripcion ?>"        <?= ($orden == "Detalles" || $orden == "Modificar")?"readonly":"" ?> size="8"></td></tr>
 <tr><td>Precio actual </td> <td>
 <input type="text" name="precio_actual" 	value="<?=$producto->precio_actual ?>"        <?= ($orden == "Detalles")?"readonly":"" ?> size=10></td></tr>
 <tr><td>Stock disponible </td><td>
 <input type="text" 	name="stock_disponible" value="<?=$producto->stock_disponible ?>" <?= ($orden == "Detalles")?"readonly":"" ?> size=20></td></tr>
 </table>
 <?php
 /* var_dump($producto); */
 ?>
 
 <input type="submit"	 name="orden" 	value="<?=$orden?>">
 <input type="submit"	 name="orden" 	value="Volver">
</form> 
</div>
</div>
</body>
</html>
<?php exit(); ?>