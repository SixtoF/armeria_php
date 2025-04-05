<?php
//iniciamos sesion
session_start();

/**
 * Si el usuario no ha iniciado sesión ni está en modo invitado,
 * se redirige a la página principal
 */
if(!isset($_SESSION['usuario']) && !isset($_GET['guest'])){
    header('location: index.php');
    exit();
}

//verificar si el usuario tiene datos de perfil
$archivo_datos = 'archivos/datosUsuarios.txt';
$tiene_datos = false;

if(file_exists($archivo_datos)){
    $datos = file($archivo_datos, FILE_IGNORE_NEW_LINES);
    foreach($datos as $linea){
        $registro = json_decode($linea, true);
        if(isset($registro['usuario']) && $registro['usuario'] === $_SESSION['usuario']){
            $tiene_datos = true;
            break;
        }
    }
}

if(!$tiene_datos && isset($_SESSION['usuario'])){
    header('location: editarDatosPerfil.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Armería - Inicio</title></head>
<body>
<h1>Bienvenido <?php echo isset($_SESSION['usuario']) ? htmlspecialchars($_SESSION['usuario']) : "Invitado"; ?></h1>
<?php if (isset($_GET['guest']) && $_GET['guest'] === "true"): ?>
    <!-- Si es invitado, solo se muestra el inventario -->
    <?php
    // Mostrar el inventario para invitados
    include "funciones/inventario_armas.php";
    mostrarInventario();
    ?>
<?php elseif (isset($_SESSION['usuario'])): ?>
    <!-- Si está logueado, mostramos más opciones -->
    <a href="buscar.php">Buscar en el inventario</a>
    <a href="administrar_cuenta.php">Administrar Cuenta</a>
    <a href="verDatosPerfil.php">Ver Datos de Perfil de Usuario</a>
    <a href="editarDatosPerfil.php">Rellenar Datos Perfil</a>
    <a href="cerrar_sesion.php">Cerrar Sesión</a>
    <?php
    include "funciones/inventario_armas.php";
    mostrarInventario();
    ?>
<?php endif; ?>

<br></br>
<h2>Si quieres acceder a mas funcionalidades Registrate.</h2>
<h3>Pulsando el link!</h3>
<a href="registrar.php">Ir a Incio para Registrarse</a>

</body>
</html>
