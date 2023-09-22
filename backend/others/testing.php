<?php

$obj = new stdClass();

$obj->callback = function() {
  return "Holanda q acelga";
};

echo call_user_func($obj->callback);

/*
echo call_user_func( function() {
  return "Hola mundordo";
});
*/

// $obj->func = "saludar";

/*
function saludar() {
  return "Hello callbacks";
}
*/


