<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Zen+Antique&display=swap" rel="stylesheet">
    <title>Fruteria</title>
</head>
<body>
    <div class="container">
    <h3>Bienvenido a la frutería</h3>
<form action="index.php" method="GET">
    <label for="nombre">Introduzca su nombre de usuario</label><br>
     <input type="text" name="nombre" value="<?=(isset($_REQUEST['nombre']))?$_REQUEST['nombre']:''?>" ><br>
    <input type="submit" name="orden" value="Entrar"> 
    </form>
    </div>
</body>
</html>





