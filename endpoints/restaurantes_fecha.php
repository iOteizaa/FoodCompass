<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
require('../util/conexion.php');

// Recibe la fecha (YYYY-MM-DD) y la hora (HH:MM:SS)
$fecha = '';
if (isset($_GET['fecha'])) {
    $fecha = trim($_GET['fecha']);
} else {
    if (isset($_POST['fecha'])) {
        $fecha = trim($_POST['fecha']);
    }
}

$hora = '';
if (isset($_GET['hora'])) {
    $hora = trim($_GET['hora']);
} else {
    if (isset($_POST['hora'])) {
        $hora = trim($_POST['hora']);
    }
}

if ($fecha === '' || $hora === '') {
    echo json_encode(['error' => 'Fecha y hora deben ser proporcionadas']);
    exit;
}

// Obtener el día de la semana en español
setlocale(LC_TIME, 'es_ES.UTF-8');
$timestamp = strtotime($fecha);
$dias_es = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
$dia_semana = $dias_es[(int)date('w', $timestamp)];

// Consulta para obtener los restaurantes abiertos en ese día y hora
$sql = "SELECT r.* FROM restaurantes r
    INNER JOIN horarios_restaurante h ON r.id = h.restaurante_id
    WHERE h.dia_semana = ?
      AND h.hora_apertura <= ?
      AND h.hora_cierre >= ?";

$stmt = $_conexion->prepare($sql);
$stmt->bind_param('sss', $dia_semana, $hora, $hora);
$stmt->execute();
$result = $stmt->get_result();

$restaurantes = [];
while ($restaurante = $result->fetch_assoc()) {
    // Procesar imágenes
    $imagenes = json_decode($restaurante['imagenes'], true) ?: [];
    // Consulta para tipos de comida de este restaurante
    $sqlTipos = "SELECT tc.id, tc.nombre 
                 FROM tipos_comida tc
                 INNER JOIN restaurante_tipo_comida rtc ON tc.id = rtc.tipo_comida_id
                 WHERE rtc.restaurante_id = ?";
    $stmtTipos = $_conexion->prepare($sqlTipos);
    $stmtTipos->bind_param('i', $restaurante['id']);
    $stmtTipos->execute();
    $resultTipos = $stmtTipos->get_result();
    $tiposComida = [];
    while ($tipo = $resultTipos->fetch_assoc()) {
        $tiposComida[] = $tipo;
    }
    $stmtTipos->close();
    $ofertas = [];
    if (isset($restaurante['ofertas'])) {
        $ofertas = json_decode($restaurante['ofertas'], true);
        if (!is_array($ofertas)) {
            $ofertas = [];
        }
    }

    $comidaHoy = false;
    if (isset($restaurante['comidaHoy'])) {
        $comidaHoy = (bool)$restaurante['comidaHoy'];
    }

    $categoria = '';
    if (isset($restaurante['categoria'])) {
        $categoria = $restaurante['categoria'];
    }

    $restaurantes[] = [
        'id' => $restaurante['id'],
        'nombre' => $restaurante['nombre'],
        'precio' => $restaurante['precio'],
        'valoraciones' => $restaurante['valoraciones'],
        'ubicacion' => $restaurante['ubicacion'],
        'descripcion' => $restaurante['descripcion'],
        'coordenadas' => [
            'latitud' => $restaurante['latitud'],
            'longitud' => $restaurante['longitud']
        ],
        'imagenes' => $imagenes,
        'tipos_comida' => $tiposComida,
        // Añadidos para compatibilidad frontend
        'ofertas' => $ofertas,
        'comidaHoy' => $comidaHoy,
        'categoria' => $categoria
    ];
}
$stmt->close();

// Respuesta JSON
echo json_encode($restaurantes, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT);
$_conexion->close();
