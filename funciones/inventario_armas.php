<?php

//funcion para mostrar el inventario.txt en una tabla
function mostrarInventario()
{
    $inventario = file("archivos/inventario.txt", FILE_IGNORE_NEW_LINES);
    echo "<h3>Inventario de Armas</h3>";
    echo "<table border='1'>";
    echo "<tr><th>Arma</th><th>Cantidad</th><th>Munición</th></tr>";
    foreach ($inventario as $linea) {
        list($arma, $cantidad, $municion) = explode(":", $linea);
        echo "<tr><td>$arma</td><td>$cantidad</td><td>$municion</td></tr>";
    }
    echo "</table>";
}

//funcion para buscar en el inventario
function buscarInventario($termino)
{
    $inventario = file("archivos/inventario.txt", FILE_IGNORE_NEW_LINES);
    $resultados = [];

    //buscamos el termino sobre cada linea
    foreach ($inventario as $linea) {
        // Usa strpos para una búsqueda sin distinguir mayúsculas y minúsculas
        if(strpos($linea, $termino) !== false){
            $resultados[] = $linea;
        }
    }

    // Muestra los resultados en una tabla
    echo "<h3>Resultados de la búsqueda: '$termino'</h3>";
    if (count($resultados) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Arma</th><th>Cantidad</th><th>Munición</th></tr>";
        foreach ($resultados as $linea) {
            list($arma, $cantidad, $municion) = explode(":", $linea);
            echo "<tr><td>$arma</td><td>$cantidad</td><td>$municion</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No se encontraron resultados para '$termino'.</p>";
    }
}