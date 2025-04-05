<?php
//Inciamos la sesion para identificar al usuario
session_start();

//verificamos si el usuario ha iniciado sesion
if(isset($_SESSION["usuario"])){
    //obtenemos la sesion actual del usuario
    $usuario = $_SESSION["usuario"];
}else{
    header("location:login.php");
    exit();
}

$datos = file("archivos/datosUsuarios.txt", FILE_IGNORE_NEW_LINES);//se lee el fichero de datos
$perfil = null;

//recorremos el fichero para encontrar el perfil de usuario
foreach ($datos as $linea) {
    $registro = json_decode($linea, true);//Decodificamos el JSON de cada linea
    if($registro["usuario"] === $usuario){//si coincide con el usuario actual
        $perfil = $registro["perfil"];//guardamos los datos del perfil
        break;
    }
}

//sino se encuantra un perfil de usuario asociado, redirigimos a editarDatosPerfil.php
if(!$perfil){
    header("location:editarDatosPerfil.php");
    exit();// se termina el script
}

?>
<!--se se encuentran el perfil del usuario, los mostramos -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos del Perfil</title>
</head>
<body>
<h2>Datos del Perfil</h2>
    <!-- Mostramos los datos del perfil si existen -->
    <p><strong>DNI:</strong> <?php echo $perfil['dni']; ?></p>
    <p><strong>Nombre:</strong> <?php echo $perfil['nombre']; ?></p>
    <p><strong>Apellido:</strong> <?php echo $perfil['apellido']; ?></p>
    <p><strong>Teléfono:</strong> <?php echo $perfil['telefono']; ?></p>
    <p><strong>Calle:</strong> <?php echo $perfil['calle']; ?></p>
    <p><strong>Número de Portal:</strong> <?php echo $perfil['numeroPortal']; ?></p>
    <p><strong>Código Postal:</strong> <?php echo $perfil['codigoPostal']; ?></p>
    <p><strong>Población:</strong> <?php echo $perfil['poblacion']; ?></p>
    <p><strong>Provincia:</strong> <?php echo $perfil['provincia']; ?></p>
    <p><strong>Nota:</strong> <?php echo $perfil['nota']; ?></p>
    <a href="home.php">Volver a Home</a>
</body>
</html>
