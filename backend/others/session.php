<?php
session_start();
echo $_SESSION["clave"];

session_unset();
session_destroy();

/*
El protocolo HTTP no mantiene estado. Cada petición es independiente de la otra, y no se puede recuperar información entre peticiones.

Session id, código alfanumérico

*/