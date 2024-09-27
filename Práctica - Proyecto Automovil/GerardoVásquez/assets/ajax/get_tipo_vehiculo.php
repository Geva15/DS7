<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/GerardoVásquez/includes/database.php');

$database = new Database();
$pdo = $database->getConnection();

if (isset($_POST['id_modelo'])) {
    // Obtener el ID de la provincia desde la solicitud AJAX
    $id_modelo = $_POST['id_modelo'];

    // Consulta para obtener los distritos de la provincia seleccionada
    $stmt = $pdo->prepare("SELECT tv.id_tipo, tv.tipo 
              FROM modelo_vehiculo m
              JOIN tipo_vehiculo tv ON m.id_tipo_fk = tv.id_tipo
              WHERE m.id_modelo = ?");
    $stmt->execute([$id_modelo]);

    // Verificar si hay distritos encontrados
    if ($stmt->rowCount() > 0) {
        echo '<option value="">Seleccione un tipo</option>';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . htmlspecialchars($row['id_tipo']) . '">' . htmlspecialchars($row['tipo']) . '</option>';
        }
    } else {
        echo '<option value="">No hay tipos disponibles</option>';
    }  
}else {
    echo '<option value="">ID de modelo no definido</option>';
}
?>