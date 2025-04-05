<?php
session_start();
//si el usuario no ha inciado sesion se redirige a la pagina principal
if(!isset($_SESSION["usuario"])){
    header("location:index.php");
    exit();
}

//procesa la ctualizacion de la cuenta cuando el formulario se envia
if($_SERVER["REQUEST_METHOD"] === "POST"){
$nuevo_usuario = $_POST["nuevo_usuario"];
$contrasena_actual = $_POST["contrasena_actual"];
$nueva_contrasena = $_POST["nueva_contrasena"];

//se carga el fichero en usuarios linea a linea
$usuarios = file("archivos/usuarios.txt", FILE_IGNORE_NEW_LINES);
$usuario_valido = false;
foreach ($usuarios as $index => $linea) {
    //se divide cada linea en nombre y hash de contraseña
    list($nombre, $hash) = explode(":", $linea);
    /**
     * comprueba que el nombre coincida con el usuario actual
     * y que la contraseña ingresada sea correcta usando password_verify.
     */

    if($nombre === $_SESSION["usuario"] && password_verify($contrasena_actual, $hash)){
    $usuario_valido = true;
    //var_dump($usuario_valido);
    $usuarios[$index] = $nuevo_usuario.":".password_hash($nueva_contrasena, PASSWORD_DEFAULT);
    $_SESSION["usuario"] = $nuevo_usuario;
    break;
    }
}

//actualiza el fichero usuarios.txt con los cambios realizados
    if($usuario_valido){
        //sobreescribimos el fichero con los datos actualizados de usuarios
        file_put_contents("archivos/usuarios.txt", implode("\n", $usuarios));
        echo "Se han actualizado los datos de su cuenta.";
    }else{
        echo "Contraseña actual incorrecta.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Administrar Cuenta</title></head>
<body>
<h2>Modificar Usuario o Contraseña</h2>
<form method="POST">
    <input type="text" name="nuevo_usuario" placeholder="Nuevo Usuario" required>
    <input type="password" name="contrasena_actual" placeholder="Contraseña Actual" required>
    <input type="password" name="nueva_contrasena" placeholder="Nueva Contraseña" required>
    <button type="submit">Actualizar</button>
</form>
</body>
</html>
