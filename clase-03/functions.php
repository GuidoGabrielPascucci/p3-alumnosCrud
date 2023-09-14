<?php

// FUNCIONES PRINCIPALES
function listarAlumnos() {
  $obj = leerArchivo("agregarSaltoDeLinea");
  if ($obj) mostrarArchivo($obj);
}

function validarDatos() {

}

function agregarAlumno() {

  if (!validarEntradas('nombre', 'apellido', 'legajo')) echo MISSING_INPUT_MESSAGE;
  else if (escribirArchivo("concatenarRegistro")) echo WRITE_FILE_SUCCESS_MESSAGE;
  else echo "HUBO ERROR AL ESCRIBIR EL ARCHIVO";

}

function escribirArchivo($func) {

  $modo = "";

  switch ($func) {
    case "concatenarRegistro":
      $modo = 'a';
      break;

    default:
      $modo = "jaj";
  }

  if (!file_exists(PATH)) mkdir(DIRECTORY_NAME);
  $fileResource = fopen(PATH, $modo);
  fwrite($fileResource, $data);
  fclose($fileResource);

}

function concatenarRegistro() {

  $legajo = $_POST['legajo'];
  $apellido = $_POST['apellido'];
  $nombre = $_POST['nombre'];

  $data = "$legajo - $apellido - $nombre\n";
  $mode = 'a';

}

function verificarAlumno() {
  if (!validarEntradas('legajo')) echo MISSING_INPUT_MESSAGE;
  else {
    $obj = leerArchivo("verificarExistenciaDeLegajo");
    if ($obj) mostrarVerificacionDeLegajo($obj);
  }
}

function modificarAlumno() {

  if (!validarEntradas('nombre', 'apellido', 'legajo')) {

    echo MISSING_INPUT_MESSAGE;

  } else {

    escribirArchivo('');
    
  }

  if (!validarEntradas($nombre, $apellido, $legajo))
    echo MISSING_INPUT_MESSAGE;
  else {

    leerArchivo("verificarExistenciaDeLegajo", "callback2");

    // $data = "$legajo - $apellido - $nombre\n";
    // $mode = 'a';
    // if (!file_exists(PATH)) mkdir(DIRECTORY_NAME);
    // $fileResource = fopen(PATH, $mode);
    // fwrite($fileResource, $data);
    // fclose($fileResource);
    // echo FILE_WRITTEN_MESSAGE;
  }

}

// FUNCIONES SECUNDARIAS
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

function agregarSaltoDeLinea(string $linea, stdClass $obj) {
  if (!isset($obj->data)) $obj->data = "";
  $obj->data .= $linea . "<br>";
}

function mostrarArchivo(stdClass $obj) {
  if (!isset($obj->data) || gettype($obj->data) != "string" || $obj->data === "") {
    echo ERR_READING_FILE_MESSAGE;
  } else {
    echo $obj->data;
  }
}

function verificarExistenciaDeLegajo(string $linea, stdClass $obj) {
  $obj->numeroLegajo = $_POST['legajo'];
  $obj->existeLegajo = false;
  $campos = explode('-', $linea);
  
  foreach ($campos as $campo) {
    if (trim($campo) == $obj->numeroLegajo) {
      $obj->existeLegajo = true;
      $obj->finalizarBucle = true;
      break;
    }
  }
}

function mostrarVerificacionDeLegajo(stdClass $obj) {
  if (!isset($obj->existeLegajo) || gettype($obj->existeLegajo) != "boolean") {
    echo ERR_READING_FILE_MESSAGE;
  } else if ($obj->existeLegajo) {
    echo "El alumno con legajo $obj->numeroLegajo se encuentra en el listado";
  } else {
    echo "El alumno con legajo $obj->numeroLegajo no se encuentra en el listado";
  }
}



/*
Recuperar los valores enviados y buscar en el archivo ./archivos/alumnos.txt la
existencia de un registro que coincida con el legajo recuperado.
● Si se encuentra, reemplazar el apellido y el nombre del archivo, por los
valores recuperados por POST.
Mostrar un mensaje que diga: 'El alumno con legajo 'xxx' se ha modificado'
● Si no se encuentra, mostrar el siguiente mensaje:
'El alumno con legajo 'xxx' no se encuentra en el listado'
Siendo 'xxx' el valor del legajo enviado por POST.
*/




// function agregarAlumno() {

//   $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
//   $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : null;
//   $legajo = isset($_POST['legajo']) ? $_POST['legajo'] : null;
  
//   if (!validarEntradas($nombre, $apellido, $legajo))
//     echo MISSING_INPUT_MESSAGE;
//   else {
//     $data = "$legajo - $apellido - $nombre\n";
//     $mode = 'a';
//     if (!file_exists(PATH)) mkdir(DIRECTORY_NAME);
//     $fileResource = fopen(PATH, $mode);
//     fwrite($fileResource, $data);
//     fclose($fileResource);
//     echo FILE_WRITTEN_MESSAGE;
//   }

// }