<?php

// -------------------------------------------------------
define("num_caracteres", 256);  

function noIterate($strArr) 
{
    // colocar elementos de array en variables
    $cadena = $strArr[0];
    $patron = $strArr[1];

    // Definiendo valores segun longitud de los string dados.
    // De cadena y patron
    $cad1 = strlen($cadena);  
    $cad2 = strlen($patron);  
  
    /**
     * Verifica si la cadena es mayor que el patrón
     */ 
    if ($cad1 < $cad2)  
    {  
        echo "* Invalido, Cad2 es mayor que Cad1\n";  
        return "** El patrón debe ser menor que la cadena a validar";  
    }  
  
    //Llena los arrays con valores determinado en la constante
    $hash_patron = array_fill(0, num_caracteres, 0);  
    $hash_cadena = array_fill(0, num_caracteres, 0);  
  
    // Almacenar ocurrencia de caracteres de patrón 
    for ($i = 0; $i < $cad2; $i++)  
        $hash_patron[ord($patron[$i])]++;  
  
    $inicio = 0; 
    $inicio_indice = -1; 
    $lon_min = PHP_INT_MAX;
  
    // Empieza a atravesar la cadena
    // Conteo de caracteres
    $count = 0; 
    for ($j = 0; $j < $cad1 ; $j++)  
    {  
        // Conteo de ocurrencia de caracteres de la cadena  
        $hash_cadena[ord($cadena[$j])]++;  
  
        /**
         * Si el carácter de la cadena coincide con el carácter 
         * del patrón, incremente el recuento
         */
        if ($hash_patron[ord($cadena[$j])] != 0 &&  
            $hash_cadena[ord($cadena[$j])] <= $hash_patron[ord($cadena[$j])])  
            $count++;  
  
        // Si todos los caracteres coinciden  
        if ($count == $cad2)  
        {  
            /**
             * Verificando si apararece algun carácter mas Número de veces
             * que su aparición en el patrón, en caso se que sí, entonces se elimina
             * del inicio y tambien se elimina los caracteres inservibles.
             */
            while ($hash_cadena[ord($cadena[$inicio])] > $hash_patron[ord($cadena[$inicio])] ||  
                   $hash_patron[ord($cadena[$inicio])] == 0)  
            {  
  
                if ($hash_cadena[ord($cadena[$inicio])] > $hash_patron[ord($cadena[$inicio])])  
                    $hash_cadena[ord($cadena[$inicio])]--;  
                $inicio++;  
            }  
  
            // Actualizando el tamaño de la entrada
            $longitud_entrada = $j - $inicio + 1;  
            if ($lon_min > $longitud_entrada)  
            {  
                $lon_min = $longitud_entrada;  
                $inicio_indice = $inicio;  
            }  
        }  
    }  
  
    // Si no se encuentra ninguna entrada  
    if ($inicio_indice == -1)  
    {  
        return "No existe ninguna entrada para verificar";  
    }

    // Devuelve la subcadena a partir de  
    // inicio_indice y la longitud de lon_min  
    return substr($cadena, $inicio_indice, $lon_min); 
}
    
$cadenota = ["aaffhkksemckelloe", "fhea"];

// keep this function call here
echo noIterate($cadenota);  