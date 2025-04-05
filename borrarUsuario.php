<?php
define('ARCHIVO_ADMIN', 'archivos/admin.txt');
define('ARCHIVO_USUARIOS', 'archivos/usuarios.txt');

//funcion para verificar si es administrador
function  esAdministrador($usuario, $contrasena)
{
    $datosAdmin = file(ARCHIVO_ADMIN, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($datosAdmin as $linea) {
        list($adminUsuario, $adminContrasena) = explode(":", $linea);
        if($usuario === $adminUsuario && $contrasena === $adminContrasena){
            return true;
        }
    }
    return false;
}

//funcion para borrar un usuario del fichero usuarios.txt
function borrarUsuario($usuarioABorrar){
    $usuarios = file(ARCHIVO_USUARIOS, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $nuevoContenidoFichero = "";

    $usuarioEncontrado = false;
    foreach ($usuarios as $linea) {
        list($usuario, $hashedContrasena) = explode(":", $linea);
        if($usuario !== $usuarioABorrar){
            $nuevoContenidoFichero .= $usuario . "\n";
        }else{
            $usuarioEncontrado = true;
        }
    }

    if($usuarioEncontrado){
        file_put_contents(ARCHIVO_USUARIOS, $nuevoContenidoFichero);
        return "El usuario " . $usuarioABorrar . " ha sido borrado.";
    }else{
        return "El usuario". $usuarioABorrar ." no existe.";
    }
}

//solicitud del POST del formulario
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $adminUsuario = $_POST["adminUsuario"];
    $adminContrasena = $_POST["adminContrasena"];
    $usuarioABorrar = $_POST["usuarioBorrar"];

    if(esAdministrador($adminUsuario, $adminContrasena)){
        $mensaje = borrarUsuario($usuarioABorrar);
    }else{
        $mensaje = "Credenciales admin incorrectas";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
</head>
<body>
<h1>Administrador - Eliminar Usuario</h1>
<?php if (isset($mensaje)) echo "<p style='color: blue;'>$mensaje</p>"; ?>
<form method="POST" action="">
    <label for="adminUsuario">Usuario Administrador:</label>
    <input type="text" id="adminusuario" name="adminUsuario" required><br><br>
    <label for="adminContrasena">Contraseña Administrador:</label>
    <input type="password" id="adminContrasena" name="adminContrasena" required><br><br>
    <label for="usuarioBorrar">Usuario a borrar:</label>
    <input type="text" id="usuariOBorrar" name="usuarioBorrar" required><br><br>
    <button type="submit">Eliminar Usuario</button>
</form>
<br><br>

<!-- Botón para volver al index.php -->
<br>
<form action="public/index.php" method="get">
    <button type="submit">Volver al Inicio</button>
</form>

</body>
</html>

