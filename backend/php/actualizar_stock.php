<?php
// actualizar_stock.php

// Incluir tu archivo de conexión a la base de datos
require 'Conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados desde el front-end
    $data = json_decode(file_get_contents('php://input'), true);
    $codpro = $data['medicamento']; // Código del producto
    $cantidad = $data['cantidad']; // Cantidad a descontar

    try {
        // Preparar la consulta para actualizar el stock
        $stmt = $pdo->prepare("UPDATE product SET stock = stock - :cantidad WHERE codpro = :codpro");
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':codpro', $codpro, PDO::PARAM_STR);
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Stock actualizado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el stock.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>
