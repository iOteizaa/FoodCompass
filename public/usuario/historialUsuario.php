<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require('../../util/conexion.php');

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT 
    u.id AS usuario_id,
    u.usuario,
    r.id AS restaurante_id,
    r.nombre AS restaurante,
    h.valoracion,
    h.descripcion,
    h.fecha_visita
FROM 
    historial_visitas h
JOIN usuarios u ON h.usuario_id = u.id
JOIN restaurantes r ON h.restaurante_id = r.id
WHERE h.usuario_id = ?
ORDER BY h.fecha_visita DESC";

$stmt = $_conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Historial de Visitas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/historialUsuario.css">
    <script src="../js/historial.js"></script>
</head>

<body>
    <div class="container">
        <header>
            <h1>Mi Historial Gastronómico</h1>
            <p class="subtitle">Todos los restaurantes que has visitado y valorado</p>
        </header>

        <?php if ($resultado && $resultado->num_rows > 0): ?>
            <div class="historial-list">
                <?php while ($visita = $resultado->fetch_assoc()): ?>
                    <div class="visita-card">
                        <div class="card-header">
                            <h2 class="restaurante-nombre"><?= htmlspecialchars($visita['restaurante']) ?></h2>
                            <div class="fecha-visita">
                                <i class="far fa-calendar-alt"></i>
                                <?= date('d/m/Y H:i', strtotime($visita['fecha_visita'])) ?>
                            </div>
                            <?php
                            $valoracion = $visita['valoracion'];
                            $colorClass = '';
                            if ($valoracion < 5) {
                                $colorClass = 'bad';
                            } elseif ($valoracion >= 5 && $valoracion <= 7) {
                                $colorClass = 'medium';
                            } else {
                                $colorClass = 'good';
                            }
                            ?>
                            <div class="valoracion <?= $colorClass ?>">
                                <?= $valoracion ?>/10
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="usuario-info">
                                <div class="avatar">
                                    <?= strtoupper(substr($visita['usuario'], 0, 1)) ?>
                                </div>
                                <div class="username">@<?= htmlspecialchars($visita['usuario']) ?></div>
                            </div>
                            <?php if (!empty($visita['descripcion'])): ?>
                                <div class="comentario">
                                    <?= htmlspecialchars($visita['descripcion']) ?>
                                </div>
                            <?php endif; ?>
                            <button class="btn-valorar" data-restaurante="<?= htmlspecialchars($visita['restaurante']) ?>" data-restaurante-id="<?= $visita['restaurante_id'] ?>">Valorar</button>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="no-historial">
                <div class="no-historial-icon">🍽️</div>
                <h2>Tu historial está vacío</h2>
                <p>Aún no has visitado y valorado ningún restaurante. Cuando lo hagas, aparecerán aquí tus experiencias gastronómicas.</p>
                <a href="../index.php" class="explore-btn">Explorar restaurantes</a>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>

<?php
$stmt->close();
?>