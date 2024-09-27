<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/GerardoVásquez/includes/database.php');

$database = new Database();
$pdo = $database->getConnection();

if (isset($_POST['id_marca'])) {
    // Obtener el ID de la provincia desde la solicitud AJAX
    $marca = $_POST['id_marca'];

    // Consulta para obtener los distritos de la provincia seleccionada
    $stmt = $pdo->prepare("SELECT * FROM modelo_vehiculo WHERE id_marca_fk = ?");
    $stmt->execute([$marca]);

    // Verificar si hay distritos encontrados
    if ($stmt->rowCount() > 0) {
        echo '<option value="">Seleccione un modelo</option>';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . htmlspecialchars($row['id_modelo']) . '">' . htmlspecialchars($row['modelo']) . '</option>';
        }
    } else {
        echo '<option value="">No hay modelos disponibles</option>';
    }
}
?>