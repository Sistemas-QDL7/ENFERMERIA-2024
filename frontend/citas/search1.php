<?php
require_once('../../backend/bd/Conexion.php');

$searchTerm = $_GET['term']; // Obtener el término de búsqueda de la solicitud

// Consulta para buscar pacientes por número de historia clínica
$sql = "SELECT nompro FROM product WHERE codpro or nompro LIKE :term LIMIT 10";
$stmt = $connect->prepare($sql);
$stmt->execute([':term' => "%$searchTerm%"]);
$results1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results1);
?>