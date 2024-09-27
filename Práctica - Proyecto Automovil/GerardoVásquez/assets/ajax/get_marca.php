<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/GerardoVásquez/includes/database.php');

$database = new Database();
$pdo = $database->getConnection();

$query = "SELECT * FROM marca_vehiculo";
$stmt = $pdo->prepare($query);
$stmt->execute();

$options = '<option value="">Seleccione una marca</option>';
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $options .= '<option value="' . $row['id_marca'] . '">' . htmlspecialchars($row['marca']) . '</option>';
}

echo $options;
?>