<?php

function sumar(float $a, float $b) {
  return $a + $b;
}

function restar(float $a, float $b) {
  return $a - $b;
}

function multiplicar(float $a, float $b) {
  return $a * $b;
}

function dividir(float $a, float $b) {
  return $b != 0 ? $a / $b : "No se puede dividir por cero";
}

function realizarOperacion($func, $a, $b) {
  return call_user_func($func, $a, $b);
}