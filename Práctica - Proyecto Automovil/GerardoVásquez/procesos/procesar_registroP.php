<?php
// Incluir archivos de conexión y clase Automovil
include '../includes/database.php';
include '../includes/propietario.php';

$response = [
    'status' => false,
    'message' => 'Error desconocido.'
];

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection();

// Crear una instancia de la clase Automovil
$propietario = new Propietario($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $propietario->cedula = $_POST['cedula'];
    $propietario->nombre = $_POST['nombre'];
    $propietario->apellido = $_POST['apellido'];
    $propietario->direccion = $_POST['direccion'];
    $propietario->telefono = $_POST['telefono'];
    $propietario->tipo = $_POST['tipo'];

    // Registrar el automóvil
    if ($propietario->registrar()) {
        
        // Redirigir al formulario de registro de automóvil, pasando el id_propietario en la URL
        header("Location: ../registrar_vehiculo.php?cedula=$propietario->cedula");
        exit();
    } else {
        echo "Error al registrar propietario.";
    }

}
?>