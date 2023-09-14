<?php

/**
 * Comprueba que las claves pasadas por parámetro sean claves válidas (seteadas) en la variable superglobal Post.
 * @param string ...$entradas Las claves que se precisa validar. Si alguna de estas no es una clave válida que apunta a un elemento para el array asociativo $_POST, la validación no pasará.
 * @return boolean El resultado de la validación: true si pasa la validación, false si no la pasa.
 */
function validarEntradas(string ...$entradas): bool {

  $validacion = true;

  foreach ($entradas as $entrada) {
    if (!isset($_POST[$entrada])) $validacion = false;
  }

  return $validacion;
}