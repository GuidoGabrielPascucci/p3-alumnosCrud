<?php
require 'functions.php';
require 'constants.php';

if (isset($_REQUEST['accion'])) {
  
  switch($_REQUEST['accion']) {

    case "listar":
      listarAlumnos();
      break;
  
    case "agregar":
      agregarAlumno();
      break;
  
    case "verificar":
      verificarAlumno();
      break;

    case "modificar":
      modificarAlumno();
      break;

    default:
      echo ERR_ACTION_INPUT_MESSAGE;
      break;    
  }

}
