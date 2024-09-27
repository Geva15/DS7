<?php
// Incluir archivos de conexión y clase Automovil
include '../includes/database.php';
include '../includes/vehiculo.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection();

// Crear una instancia de la clase Automovil
$vehiculo = new Vehiculo($db);

$placa = $_GET['buscar'];

// Realizar la búsqueda de la placa usando el método buscar
$resultado = $vehiculo->buscar($placa);

if (is_array($resultado)) {
    // Si se encontraron resultados, construir la tabla
    echo '<table border="1">';
    echo '<tr><th>Placa</th><th>Marca</th><th>Modelo</th><th>Año</th><th>Color</th><th>Número de Motor</th><th>Número de Chasis</th><th>Tipo de Vehículo</th></tr>';
    echo '<tr id="solin">';
    echo '<td>' . htmlspecialchars($resultado['placa']) . '</td>';
    echo '<td>' . htmlspecialchars($resultado['marca']) . '</td>';
    echo '<td>' . htmlspecialchars($resultado['modelo']) . '</td>';
    echo '<td>' . htmlspecialchars($resultado['anio']) . '</td>';
    echo '<td>' . htmlspecialchars($resultado['color']) . '</td>';
    echo '<td>' . htmlspecialchars($resultado['numero_motor']) . '</td>';
    echo '<td>' . htmlspecialchars($resultado['numero_chasis']) . '</td>';
    echo '<td>' . htmlspecialchars($resultado['tipo_vehiculo']) . '</td>';
    echo '</tr>';
    echo '</table>';
} else {
    // Si no se encontraron resultados
    echo '<p>' . htmlspecialchars($resultado) . '</p>';
}
?>