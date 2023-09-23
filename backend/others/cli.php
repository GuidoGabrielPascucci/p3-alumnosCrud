<?php
/*
fwrite(STDERR, "An error occurred.\n");
exit(1); // A response code other than 0 is a failure
*/

/*
$obj = new stdClass();
$obj->func = function() {
      return $this;
};
call_user_func($obj->func);
echo 'buenas noches';
*/

echo 'hello<br><br>';
$miVariable = "Hola";

$obj = new stdClass();
$obj->datoInt = 10;
$obj->funcion = function() use ($obj) {
      echo "<br>Dentro de la función<br>";
      var_dump($obj);
};


$obj->datoInt = 5;
call_user_func($obj->funcion);