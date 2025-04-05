<?php
//inicializamos contadores si las cookies no existen
if(!isset($_COOKIE['contador_registros'])){
    //si la cookie no existe la inicializamos a 0
    setcookie("contador_registros", 0, time() + (86400 * 30), "/");//la cookie dura 30 dias
}

if(!isset($_COOKIE['contador_invitados'])){
    //si la cookie no existe, la inicalizamos a 0
    setcookie("contador_invitados", 0, time() + (86400 * 30), "/");
}

//verificamos si obtenemos el parametro 'action' de la URL(?action=registro)
if(isset($_GET['action'])){
    if($_GET['action'] === 'registro'){
        //incrementamos el contador
        $contadorRegistros = isset($_COOKIE['contador_registros']) ? $_COOKIE['contador_registros'] + 1 : 1;
        //se actualiza la cookie con el nuevo valor
        setcookie('contador_registros', $contadorRegistros, time() + (86400 * 30), "/");

        //redirigimos al usuario a la pagina de registro
        header('Location: ../registrar.php');
        exit();
    }elseif ($_GET['action'] === 'invitado'){
        //incrementamos el contador invitado
        $contadorInvitados = isset($_COOKIE['contador_invitados']) ? $_COOKIE['contador_invitados'] + 1 : 1;
        //actualizamos el valor de la cookie
        setcookie('contador_invitados', $contadorInvitados, time() + (86400 * 30), "/");

        //redirigimos a la pagina de home como invitado
        header('Location: ../home.php?guest=true');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Armería - Página Principal</title>
</head>
<body>
<h1>Bienvenido a la Armería</h1>
<!-- Enlaces a las opciones de la página principal -->
<!-- Al hacer clic, se pasa un parámetro 'action' en la URL para gestionar el contador -->
<a href="?action=registro">Registrarse</a>
<a href="../login.php">Iniciar Sesión</a>
<a href="?action=invitado">Entrar como Invitado</a>
<br><br>

<!-- Botón para redirigir a borrarUsuario.php -->
<form action="../borrarUsuario.php" method="get" style="display: inline;">
    <button type="submit">Iniciar Sesión como Administrador</button>
</form>

<!-- Mostrar estadísticas basadas en las cookies -->
<h2>Estadísticas:</h2>
<!-- Mostrar el valor de 'contador_registros' -->
<p>Total registros: <?php echo $_COOKIE['contador_registros'] ?? 0; ?></p>
<!-- Mostrar el valor de 'contador_invitados' -->
<p>Total accesos como invitado: <?php echo $_COOKIE['contador_invitados'] ?? 0; ?></p>
</body>
</html>