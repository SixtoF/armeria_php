<?php
require_once 'funciones/Direccion.php';
session_start();//Iniciamos la sesion para obtener la el usuario actual

if($_SERVER['REQUEST_METHOD'] === 'POST'){//verificamos que el formulario fue enviado
    //comprobamos que el usuario ha iniciado sesion
    if(!isset($_SESSION['usuario'])){
        //sino ha iniciado sesion se envia al login para que inicie sesion
        header('Location: login.php');
        exit();
    }
    //almacenamos en usuario el nombre de usuario desde la sesion
    $usuario = $_SESSION['usuario'];

    //creo un objeto direccion con los datos enviados del POST
    $direccion = new Direccion(
        $_POST['dni'],
        $_POST['nombre'],
        $_POST['apellido'],
        $_POST['telefono'],
        $_POST['calle'],
        $_POST['numeroPortal'],
        $_POST['codigoPostal'],
        $_POST['poblacion'],
        $_POST['provincia'],
        $_POST['nota']
    );

    //convierte los datos en un JSON y asociamos el usuario
    $linea = json_encode(['usuario' => $usuario, 'perfil' => $direccion->toArray()]) . "\n";

    //se guarda el objeto JSON en el archivo datosUsuarios.txt
    file_put_contents('archivos/datosUsuarios.txt', $linea, FILE_APPEND);

    //si los datos se guardan correctamente accede a ver sus datosdePerfil
    header('Location: verDatosPerfil.php');
    exit();
}

//si el formulario no se ha enviado, verificamos si existen datos del usuario
if(isset($_SESSION['usuario'])){
    $usuario = $_SESSION['usuario'];
    $datos = file("archivos/datosUsuarios.txt", FILE_IGNORE_NEW_LINES);
    $perfil = null;

    //buscamos datos del usuario en el fichero
    foreach ($datos as $line) {
        $registro = json_decode($line, true);
        if($registro['usuario'] === $usuario){
            $perfil = $registro['perfil'];// si encontramos datos, los almacenamos
            break;
        }
    }

    //si los datos ya existen, los mostramos para que el usuario los edite
    if($perfil){
        $dni = $perfil['dni'];
        $nombre = $perfil['nombre'];
        $apellido = $perfil['apellido'];
        $telefono = $perfil['telefono'];
        $calle = $perfil['calle'];
        $numeroPortal = $perfil['numeroPortal'];
        $codigoPostal = $perfil['codigoPostal'];
        $poblacion = $perfil['poblacion'];
        $provincia = $perfil['provincia'];
        $nota = $perfil['nota'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Datos de Perfil</title>
</head>
<body>
<h2>Editar Datos de Perfil</h2>
<form method="POST">
    <!-- Rellenamos los campos con los datos existentes si están disponibles -->
    <label for="dni">DNI:</label><br>
    <input type="text" name="dni" value="<?php echo $dni ?? ''; ?>" required><br>
    <!--php:Si existe una variable $dni en el código PHP, su valor será el que se muestre en el campo.
    ?? '': Esta es la coalescencia nula de PHP. Si $dni no está definido o es null,
    entonces el valor será una cadena vacía (''). -->

    <label for="nombre">Nombre:</label><br>
    <input type="text" name="nombre" value="<?php echo $nombre ?? ''; ?>" required><br>

    <label for="apellido">Apellido:</label><br>
    <input type="text" name="apellido" value="<?php echo $apellido ?? ''; ?>" required><br>

    <label for="telefono">Teléfono:</label><br>
    <input type="text" name="telefono" value="<?php echo $telefono ?? ''; ?>" required><br>

    <label for="calle">Calle:</label><br>
    <input type="text" name="calle" value="<?php echo $calle ?? ''; ?>" required><br>

    <label for="numeroPortal">Número de Portal:</label><br>
    <input type="text" name="numeroPortal" value="<?php echo $numeroPortal ?? ''; ?>" required><br>

    <label for="codigoPostal">Código Postal:</label><br>
    <input type="text" name="codigoPostal" value="<?php echo $codigoPostal ?? ''; ?>" required><br>

    <label for="poblacion">Población:</label><br>
    <input type="text" name="poblacion" value="<?php echo $poblacion ?? ''; ?>" required><br>

    <label for="provincia">Provincia:</label><br>
    <input type="text" name="provincia" value="<?php echo $provincia ?? ''; ?>" required><br>

    <label for="nota">Nota:</label><br>
    <textarea name="nota"><?php echo $nota ?? ''; ?></textarea><br>

    <button type="submit">Guardar Cambios</button>
</form>
</body>
</html>
