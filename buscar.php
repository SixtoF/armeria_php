<?php
session_start();
include 'funciones/inventario_armas.php';

//verifica si el usuario esta autentficado o esta ingresando como invitado
if(!isset($_SESSION['usuario']) && !isset($_GET['guest'])){
    header('location: index.php');
    exit();
}

//se guarda el termino de busqueda desde el fomulario
$termino = isset($_GET['busqueda']) ? $_GET['busqueda'] : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar en Inventario</title>
</head>
<body>
<h2>Buscar en el Inventario de Armas</h2>

<!-- Formulario de búsqueda -->
<form method="GET" action="buscar.php">
    <input type="text" name="busqueda" placeholder="Buscar en el inventario"
           value="<?php echo htmlspecialchars($termino ?: '', ENT_QUOTES, 'UTF-8'); ?>">
    <button type="submit">Buscar</button>
</form>

<?php
// Si se ha ingresado un término, realiza la búsqueda;
// de lo contrario, muestra el inventario completo
if ($termino) {
    buscarInventario($termino);
} else {
    echo "<p>Introduce un término para buscar en el inventario.</p>";
}
?>

<a href="home.php">Volver al Inventario</a>
<a href="administrar_cuenta.php">Administrar Cuenta</a>
</body>
</html>

