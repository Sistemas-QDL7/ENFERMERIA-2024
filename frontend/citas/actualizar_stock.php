<?php
require_once('../../backend/bd/Conexion.php');
$data = json_decode(file_get_contents("php://input"), true);
$codpro = $data['codpro'];
$cantidad = $data['cantidad'];

// Validar que se envíen los datos correctos
if (!isset($codpro) || !isset($cantidad)) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

// Verificar que el stock sea suficiente
$sql = "SELECT stock FROM product WHERE codpro = :codpro";
$stmt = $connect->prepare($sql);
$stmt->bindParam(':codpro', $codpro, PDO::PARAM_STR);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
    exit;
}

if ($product['stock'] < $cantidad) {
    echo json_encode(['success' => false, 'message' => 'Stock insuficiente']);
    exit;
}

// Actualizar el stock del producto
$sql = "UPDATE product SET stock = stock - :cantidad WHERE codpro = :codpro";
$stmt = $connect->prepare($sql);
$stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
$stmt->bindParam(':codpro', $codpro, PDO::PARAM_STR);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
