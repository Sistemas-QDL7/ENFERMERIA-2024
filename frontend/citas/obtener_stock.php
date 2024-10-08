<?php
require_once('../../backend/bd/Conexion.php');
$codpro = $_GET['codpro'];

// Consulta para obtener el stock
$sql = "SELECT stock FROM product WHERE codpro = :codpro";
$stmt = $connect->prepare($sql);
$stmt->bindParam(':codpro', $codpro, PDO::PARAM_STR);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if ($product) {
    echo json_encode(['stock' => $product['stock']]);
} else {
    echo json_encode(['stock' => 'No disponible']);
}
?>
