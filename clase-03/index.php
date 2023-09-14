<?php

function handleWarnings(int $num, string $msje) {
  throw new ErrorException($msje, $num);
}

// set_error_handler("handleWarnings");
// "Se ha producido un error!"

try {
  unlink("some.noexist");
} catch (Exception $ex) {
  echo "Atrapamos la excepción en el catch - No paso nada";
}

//E_WARNING