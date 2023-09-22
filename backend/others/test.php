<?php
//echo file_get_contents($filename);

$filename = './some.txt';
$fp = fopen($filename, 'r+');
$data = "Banega\n";
// Paramos el puntero en $x (posición 24)
$x = 24;
fseek($fp, $x);
// Leemos la línea
$linea = fgets($fp);
// Indicamos posición actual ($y) luego de leer línea
$y = ftell($fp);
// Obtenemos el resto del archivo en $fileContent
$fileContent = fread($fp, filesize($filename) - ftell($fp));
// 
$pos = strpos($linea, " ");
// Volvemos a la posición exacta a comenzar el borrado
fseek($fp, $x + ($pos + 1));
// Truncamos archivo
ftruncate($fp, ftell($fp));
// Concatenamos data
$data .= $fileContent;
fwrite($fp, $data);
fclose($fp);



/*
$posicion = strpos($linea, " ");
$a = $x + $posicion + 1;
fseek($fp, $a);
fwrite($fp, $data);
fclose($fp);
*/


//$result = fwrite($fp, $data);
//echo $result;






/*
$filename = './some.txt';
$fp = fopen($filename, 'r');
$data = "";

while (!feof($fp)) {
  $posicion = ftell($fp);
  $linea = $posicion . " - " . fgets($fp) . '<br>';
  $data .= $linea;
}

echo $data;
*/


//if ($result) echo "Archivo escrito con éxito";
//else echo "No se escribió un carajo";



/*
$a = "Hola PHP";
$b = 1;

echo $a . $b;
*/


// function sumar($a, $b = null): int {
//   return $a / $b;
// }

// echo sumar(4);