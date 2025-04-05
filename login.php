<?php
//inicia sesion para acceder a los datos de la sesion
session_start();

//procesa el formulario de inicio de sesion cuando se envia
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    //se lee los usuarios y contraseñas del fichero usuarios.txt
    $usuarios = file("archivos/usuarios.txt", FILE_IGNORE_NEW_LINES);
    foreach ($usuarios as $linea){
        list($nombre, $hash) = explode(":", $linea);
        //se verifica usuario y contraseña, utilizando password_verify
        if($nombre === $usuario && password_verify($contrasena, $hash)){
            $_SESSION['usuario'] = $usuario;
            header('Location: home.php');
            exit();
        }
    }
    echo "Usuario o contraseña incorrectos";
}
?>

<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Iniciar Sesión</title></head>
<body>
<h2>Iniciar Sesión</h2>
<form method="POST">
    <input type="text" name="usuario" placeholder="Usuario" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <button type="submit">Iniciar Sesión</button>
</form>
</body>
</html>
