<?php
// Incluir archivos de conexión y clase Automovil
include '../includes/database.php';
include '../includes/vehiculo.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection();

// Crear una instancia de la clase Automovil
$vehiculo = new Vehiculo($db);

// Obtener los datos del formulario
$vehiculo->placa = $_POST['placa'];
$vehiculo->anio = $_POST['anio'];
$vehiculo->color = $_POST['color'];
$vehiculo->numero_motor = $_POST['numero_motor'];
$vehiculo->numero_chasis = $_POST['numero_chasis'];
$vehiculo->cedula_fk = $_POST['propietario'];
$vehiculo->id_marca = $_POST['marca'];
$vehiculo->id_modelo = $_POST['modelo'];
$vehiculo->id_tipo = $_POST['tipo_vehiculo'];

// Inicializar variables para el mensaje
$mensaje = "";
$tipo = "error"; // Valor por defecto

// Registrar el automóvil
try {
    $registroExitoso = $vehiculo->registrar($vehiculo->cedula_fk);
    if ($registroExitoso) {
        $mensaje = "Registro realizado exitosamente.";
        $tipo = "success";
    } else {
        $mensaje = "Error al registrar el automóvil.";
    }
} catch (Exception $e) {
    $mensaje = "Error: " . $e->getMessage();
    $tipo = "error";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado del Registro</title>
    <!-- Incluir SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>
<body>
</body>
<script> 
    Swal.fire({
    title: "<?php echo $mensaje; ?>",
    icon: "<?php echo $tipo; ?>",
    showConfirmButton: false,
    timer: 5000
    }).then(() => {
        window.location.href = 'http://localhost/GerardoVásquez/registrar_propietario.php';
    });
</script>
</html>
