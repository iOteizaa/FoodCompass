<?php
session_start();
header('Content-Type: application/json');
require('../../util/conexion.php');

try {
    // Verifica si hay sesión activa
    if (!isset($_SESSION['usuario_id'])) {
        echo json_encode([
            'success' => false,
            'redirect_to_login' => './usuario/iniciosesion.php?redirect=' . urlencode($_SERVER['HTTP_REFERER'])
        ]);
        exit;
    }

    // Establecer el conjunto de caracteres a UTF-8
    $_conexion->set_charset("utf8");

    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['restaurante_id'])) {
        throw new Exception('Falta restaurante_id');
    }

    $usuario_id = intval($_SESSION['usuario_id']);
    $restaurante_id = intval($data['restaurante_id']);

    // Insertar la visita con fecha actual
    $stmt = $_conexion->prepare("INSERT INTO historial_visitas (usuario_id, restaurante_id, fecha_visita) VALUES (?, ?, NOW())");

    if (!$stmt) {
        throw new Exception('Error al preparar la consulta: ' . $_conexion->error);
    }

    $stmt->bind_param("ii", $usuario_id, $restaurante_id);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Visita registrada correctamente'
        ]);
    } else {
        throw new Exception('Error al ejecutar la consulta: ' . $stmt->error);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
    exit;
}

$stmt->close();
