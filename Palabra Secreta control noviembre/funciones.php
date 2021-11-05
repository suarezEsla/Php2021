<?php


/*
 *  Devuelve una palabra al azar del array de palabras
 */
function elegirPalabra(){
    static $tpalabras = ["Madrid","Sevilla","Murcia","Malaga","Mallorca","Menorca"];
   
   return $tpalabras[array_rand($tpalabras)]; 
}


//Si la letra pasada por parámetro NO se encuentra en la palabra (se mira con strpos) se devuelve false
function comprobarLetra($letra,$cadena){
    return !( strpos ( $cadena , $letra ) === false ); 
}



//Generamos la palabra separada por guiones
function generaPalabraconHuecos ( $cadenaletras, $cadenapalabra) {
    
    
    $resu = $cadenapalabra;
    for ($i = 0; $i<strlen($resu); $i++){
        $resu[$i] = '-';
    }
    


    
    for ($i = 0; $i<strlen($cadenapalabra); $i++){
        
        if ( strpos ($cadenaletras,$cadenapalabra[$i]) !== false){
            $resu[$i]= $cadenapalabra[$i];
        }
    }
    return $resu;
}