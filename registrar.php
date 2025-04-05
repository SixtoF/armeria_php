<?php
//procesa el formualrio de registro cuando se envia
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    //verifica si el usuario ya existe en el fichero usuarios.txt
    $usuarios = file ("archivos/usuarios.txt", FILE_IGNORE_NEW_LINES);
    foreach ($usuarios as $linea) {
        list($nombre) = explode(":", $linea);
        if ($nombre === $usuario) {
            echo "Este usuario ya existe, prueba otro!";
            exit();
        }
    }

    //guarda el nuevo usuario con su contraseña hasheada en usuarios.txt
    $nuevo_usuario = $usuario. ":".password_hash($contrasena, PASSWORD_DEFAULT).PHP_EOL;
    file_put_contents("archivos/usuarios.txt", $nuevo_usuario, FILE_APPEND);
    echo "Registro reaizado correctamente. Ahora pulsa <a href = 'login.php'>Iniciar Sesion</a>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Registrarse</title></head>
<body>
<h2>Registrarse</h2>
<form method="POST">
    <input type="text" name="usuario" placeholder="Usuario" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <button type="submit">Registrarse</button>
</form>
</body>
</html>

