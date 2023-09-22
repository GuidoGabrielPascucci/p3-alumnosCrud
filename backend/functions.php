<?php
require "./validar.php";

function agregarAlumno() {
  $validacion = validarEntradas('nombre', 'apellido', 'legajo');
  switch($validacion){
    case -1:
      echo ERR_MISSING_INPUT_MESSAGE;
      break;
    case 0:
      $resultado = escribirArchivo("agregarNuevoRegistro");
      if ($resultado) echo WRITE_FILE_SUCCESS_MESSAGE;
      else echo ERR_WRITE_FILE_FAILURE_MESSAGE;
      break;
    case 1:
      echo ERR_FAILED_INPUT_MESSAGE;
      break;
  }
}

function agregarNuevoRegistro(): stdClass {
  $legajo = $_POST['legajo'];
  $apellido = $_POST['apellido'];
  $nombre = $_POST['nombre'];
  $obj = new stdClass();
  $obj->data = "$legajo - $apellido - $nombre\n";
  $obj->modo = 'a';
  return $obj;
}

function agregarSaltoDeLinea(string $linea, stdClass $obj) {
  if (!isset($obj->data)) $obj->data = "";
  $obj->data .= $linea . "<br>";
}

function escribirArchivo($func) {
  $exito = false; 
  $objEstandar = call_user_func($func);
  if ($objEstandar) {
    if (!file_exists(PATH)) mkdir(DIRECTORY_NAME);
    $fp = fopen(PATH, $objEstandar->modo);
    if (isset($objEstandar->callback)) call_user_func($objEstandar->callback, $fp);
    fwrite($fp, $objEstandar->data);
    fclose($fp);
    $exito = true;
  }
  return $exito;
}

function leerArchivo($func, $func2 = null) {
  if (!file_exists(PATH)) {
    echo ERR_NONEXISTENT_FILE_MESSAGE;
    return false;
  }
  else {
    $fp = fopen(PATH, 'r');
    $objEstandar = new stdClass();
    $objEstandar->finalizarBucle = false;
    while (!feof($fp) && !$objEstandar->finalizarBucle) {
      $objEstandar->posicionEnArchivo = ftell($fp);
      $linea = fgets($fp);
      if ($linea) call_user_func($func, $linea, $objEstandar);
    }
    if ($func2) call_user_func($func2, $objEstandar);
    return $objEstandar;
  }
}

function listarAlumnos() {
  $obj = leerArchivo("agregarSaltoDeLinea");
  if ($obj) mostrarArchivo($obj);
}

function modificarAlumno() {
  $validacion = validarEntradas('nombre', 'apellido', 'legajo');
  switch($validacion){
    case -1:
      echo ERR_MISSING_INPUT_MESSAGE;
      break;
    case 0:
      $resultado = escribirArchivo("modificarRegistroExistente");
      if ($resultado) echo WRITE_FILE_SUCCESS_MESSAGE;
      else echo ERR_LEGAJO_NOEXISTE;
      break;
    case 1:
      echo ERR_FAILED_INPUT_MESSAGE;
      break;
  }
}

function modificarRegistroExistente() {
  $objEstandar = leerArchivo('verificarExistenciaDeLegajo');
  if ($objEstandar->existeLegajo) {
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $objEstandar->data = "$apellido - $nombre\n";
    $objEstandar->modo = 'r+';
    $objEstandar->callback = function($fp) use ($objEstandar) {
      $pos_antesDeLinea = $objEstandar->posicionEnArchivo;
      fseek($fp, $pos_antesDeLinea);
      $linea = fgets($fp);
      $pos_despuesDeLinea = ftell($fp);
      $fileContent = fread($fp, filesize(PATH) - $pos_despuesDeLinea);
      $pos_despuesDeLegajo = strpos($linea, "- ");
      fseek($fp, $pos_antesDeLinea + ($pos_despuesDeLegajo + 2));
      ftruncate($fp, ftell($fp));
      $objEstandar->data .= $fileContent;
    };
    return $objEstandar;
  } else return false;
}

function mostrarArchivo(stdClass $obj) {
  if (!isset($obj->data) || gettype($obj->data) != "string" || $obj->data === "") {
    echo ERR_READING_FILE_MESSAGE;
  } else {
    echo $obj->data;
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

function verificarAlumno() {
  if (!validarEntradas('legajo')) echo MISSING_INPUT_MESSAGE;
  else {
    $obj = leerArchivo("verificarExistenciaDeLegajo");
    if ($obj) mostrarVerificacionDeLegajo($obj);
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