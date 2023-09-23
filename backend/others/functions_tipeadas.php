<?php
/*
function leerArchivo($func, $func2 = null): stdClass|bool {
  if (!file_exists(PATH)) {
    echo ERR_NONEXISTENT_FILE_MESSAGE;
    return false;
  }
  else {
    $fileResource = fopen(PATH, 'r');
    $objEstandar = new stdClass();
    $objEstandar->finalizarBucle = false;

    while (!feof($fileResource) && !$objEstandar->finalizarBucle) {
      $linea = fgets($fileResource);
      if ($linea) call_user_func($func, $linea, $objEstandar);
    }

    if ($func2) call_user_func($func2, $objEstandar);

    return $objEstandar;
  }
}
*/