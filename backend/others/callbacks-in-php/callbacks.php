<?php

require 'functions.php';

$a = 3;
$b = 2;

$resultado = realizarOperacion('sumar', $a, $b);
echo "$a + $b = " . $resultado . "<br>";

$resultado = realizarOperacion('restar', $a, $b);
echo "$a - $b = " . $resultado . "<br>";

$resultado = realizarOperacion('multiplicar', $a, $b);
echo "$a * $b = " . $resultado . "<br>";

$resultado = realizarOperacion('dividir', $a, $b);
echo "$a / $b = " . $resultado . "<br>";