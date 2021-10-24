<?php

//Función que chequea si usuario y password tienen longitud igual a 8 caracteres, y luego chequea si la contraseña es el usuario al revés
function usuarioOk($usuario, $contraseña) :bool {

  if(strlen($usuario)>=8 && strlen($contraseña)>=8 && $contraseña == strrev($usuario)){

   return ($usuario);

  }else{
     
   header('Location: entrada.php'); exit;
  }
    
}
//Función que cuenta las palabras de la opinión
function numPalabras($comentario){

  if(strlen($comentario)>0){
    echo "Hay ".str_word_count($comentario, 0)." palabras";

  }

}

function palabraMasRepetida($comentario){
  if(strlen($comentario)>0){

  $combiertearray = explode (" ", $comentario);
$muestra = array_count_values($combiertearray);
foreach ($muestra as $key => $value)
{
if ($value > 1){
  echo "La palabra más repetida es: ".$key." y se repite: ".$value." veces.<br/>";
}
}
  }
}

function letraMasRepetida($comentario){
  if(strlen($comentario)>0){
//Declaramos letras del abcdario
$letras = "abcdefghijklmnopqrstuvwxyz";
//Convertimos a mayusculas
$letras .= strtoupper($letras);
//Recorremos abcedario
for ($i = 0; $i < strlen($letras); $i++) {
  //Metemos en variable $letra según recorremos y abrimos contador
    $letra = $letras[$i];
    $contador = 0;
    //Recorremos comentario y metemos en variable $actual, si coincide se aumenta contador
    for ($x = 0; $x < strlen($comentario); $x++) {
        $actual = $comentario[$x];
        if ($actual === $letra) {
            $contador++;
        }

    }

    //Si hay algo en contador se imprime
    if ($contador > 0 ) {
        echo "La letra: $letra=";
        echo " se repite: ".$contador." veces.</br>";
        echo "\n";
    }
}






}
}
?>