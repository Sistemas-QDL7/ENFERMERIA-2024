<?php
require_once('../../backend/bd/Conexion.php');

$searchTerm = $_GET['term']; // Obtener el término de búsqueda de la solicitud

// Consulta para buscar productos por código o nombre
$sql = "SELECT codpro, nompro, stock FROM product WHERE codpro LIKE :term OR nompro LIKE :term LIMIT 10";
$stmt = $connect->prepare($sql);
$stmt->execute([':term' => "%$searchTerm%"]);
$results1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results1);
?>
