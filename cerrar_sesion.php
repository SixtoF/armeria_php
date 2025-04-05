<?php
//incicia sesion
session_start();

//destruye todas las variables de la sesion
session_unset();

//se destruye la sesion
session_destroy();

//redirigimos a la pagina de inicio
header("location: public/index.php");
exit();