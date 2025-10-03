<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require('../util/conexion.php');

// Comprobar si el admin ha iniciado sesion
$admin_id = null;
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
}

$admin_usuario = '';
if (isset($_SESSION['admin_usuario'])) {
    $admin_usuario = $_SESSION['admin_usuario'];
}

// Si no hay sesión de administrador, redirigir al login
if (!$admin_id) {
    header("Location: ./adminLog.php");
    exit();
}

// Inicializar variables
$mensaje = '';
$error = '';
$restaurantes = [];
$restaurante_editar = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        $nombre = '';
        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
        }

        $precio = '';
        if (isset($_POST['precio'])) {
            $precio = $_POST['precio'];
        }

        $valoraciones = null;
        if (!empty($_POST['valoraciones'])) {
            $valoraciones = $_POST['valoraciones'];
        }

        $ubicacion = '';
        if (isset($_POST['ubicacion'])) {
            $ubicacion = $_POST['ubicacion'];
        }

        $descripcion = '';
        if (isset($_POST['descripcion'])) {
            $descripcion = $_POST['descripcion'];
        }

        $latitud = null;
        if (!empty($_POST['latitud'])) {
            $latitud = $_POST['latitud'];
        }

        $longitud = null;
        if (!empty($_POST['longitud'])) {
            $longitud = $_POST['longitud'];
        }

        if ($valoraciones !== null && ($valoraciones < 1 || $valoraciones > 10)) {
            $error = "La valoración debe estar entre 1 y 10";
        } else {
            try {
                if ($accion == 'añadir') {
                    $stmt = $_conexion->prepare("INSERT INTO restaurantes (nombre, precio, valoraciones, ubicacion, descripcion, latitud, longitud) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("sdsssss", $nombre, $precio, $valoraciones, $ubicacion, $descripcion, $latitud, $longitud);
                    $stmt->execute();
                    $mensaje = "Restaurante añadido correctamente.";
                }

                if ($accion == 'editar') {
                    $id = $_POST['id'];
                    $stmt = $_conexion->prepare("UPDATE restaurantes SET nombre = ?, precio = ?, valoraciones = ?, ubicacion = ?, descripcion = ?, latitud = ?, longitud = ? WHERE id = ?");
                    $stmt->bind_param("sdsssssi", $nombre, $precio, $valoraciones, $ubicacion, $descripcion, $latitud, $longitud, $id);
                    $stmt->execute();
                    $mensaje = "Restaurante actualizado correctamente.";
                }

                if ($accion == 'eliminar') {
                    $id = $_POST['id'];

                    try {
                        $stmt = $_conexion->prepare("DELETE FROM horarios_restaurante WHERE restaurante_id = ?");
                        $stmt->bind_param("i", $id);
                        $stmt->execute();

                        $stmt = $_conexion->prepare("DELETE FROM restaurantes WHERE id = ?");
                        $stmt->bind_param("i", $id);
                        $stmt->execute();

                        $mensaje = "Restaurante eliminado correctamente.";
                    } catch (Exception $e) {
                        $error = "Error al eliminar restaurante: " . $e->getMessage();
                    }
                }
            } catch (Exception $e) {
                $error = "Error al ejecutar acción: " . $e->getMessage();
            }
        }
    }
}

// Obtener lista de restaurantes
$query = "SELECT * FROM restaurantes ORDER BY nombre";
$result = $_conexion->query($query);
if ($result) {
    $restaurantes = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
} else {
    $error = "Error al obtener restaurantes: " . $_conexion->error;
}

// Obtener datos para editar
if (isset($_GET['editar']) && is_numeric($_GET['editar'])) {
    $id = $_GET['editar'];
    $stmt = $_conexion->prepare("SELECT * FROM restaurantes WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $restaurante_editar = $result->fetch_assoc();
    $stmt->close();
}

// Configuración del formulario
$form_titulo = 'Añadir';
$form_accion = 'añadir';
$boton_texto = 'Añadir';

if ($restaurante_editar) {
    $form_titulo = 'Editar';
    $form_accion = 'editar';
    $boton_texto = 'Actualizar';
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Restaurantes</title>
    <link rel="stylesheet" href="../css/formRestaurante.css" />
</head>

<body>
    <div class="container">
        <h1>Administración de Restaurantes</h1>

        <?php if (!empty($mensaje)): ?>
            <div class='mensaje exito'><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class='mensaje error'><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="formulario">
            <h2>
                <?php
                if (isset($form_titulo)) {
                    echo $form_titulo;
                }
                ?>
                Restaurante
            </h2>
            <form method="post" id="form-restaurante">
                <input type="hidden" name="accion" value="<?php if (isset($form_accion)) {
                                                                echo $form_accion;
                                                            } ?>">
                <?php if ($restaurante_editar): ?>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($restaurante_editar['id']); ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required
                        value="<?php
                                if (isset($restaurante_editar['nombre'])) {
                                    echo htmlspecialchars($restaurante_editar['nombre']);
                                }
                                ?>">
                </div>

                <div class="form-group">
                    <label for="precio">Precio (cualquier número entero):</label>
                    <input type="number" id="precio" name="precio" min="1" step="1" required
                        value="<?php
                                if (isset($restaurante_editar['precio'])) {
                                    echo htmlspecialchars($restaurante_editar['precio']);
                                }
                                ?>">
                </div>

                <div class="form-group">
                    <label for="valoraciones">Valoraciones (1-10):</label>
                    <input type="number" id="valoraciones" name="valoraciones" min="1" max="10" step="0.1"
                        value="<?php
                                if (isset($restaurante_editar['valoraciones'])) {
                                    echo htmlspecialchars($restaurante_editar['valoraciones']);
                                }
                                ?>">
                </div>

                <div class="form-group">
                    <label for="ubicacion">Ubicación:</label>
                    <input type="text" id="ubicacion" name="ubicacion" required
                        value="<?php
                                if (isset($restaurante_editar['ubicacion'])) {
                                    echo htmlspecialchars($restaurante_editar['ubicacion']);
                                }
                                ?>">
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="4" required><?php
                                                                                    if (isset($restaurante_editar['descripcion'])) {
                                                                                        echo htmlspecialchars($restaurante_editar['descripcion']);
                                                                                    }
                                                                                    ?></textarea>
                </div>

                <div class="form-group">
                    <label for="latitud">Latitud:</label>
                    <input type="text" id="latitud" name="latitud"
                        value="<?php
                                if (isset($restaurante_editar['latitud'])) {
                                    echo htmlspecialchars($restaurante_editar['latitud']);
                                }
                                ?>">
                </div>

                <div class="form-group">
                    <label for="longitud">Longitud:</label>
                    <input type="text" id="longitud" name="longitud"
                        value="<?php
                                if (isset($restaurante_editar['longitud'])) {
                                    echo htmlspecialchars($restaurante_editar['longitud']);
                                }
                                ?>">
                </div>

                <button type="submit" class="btn btn-primary">
                    <?php
                    if (isset($boton_texto)) {
                        echo $boton_texto;
                    }
                    ?>
                </button>
                <?php if ($restaurante_editar): ?>
                    <a href="./editarRestaurantes.php" class="btn btn-warning" id="btn-cancelar">Cancelar</a>
                <?php endif; ?>
            </form>
        </div>

        <h2>Lista de Restaurantes</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Valoración</th>
                    <th>Ubicación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($restaurantes)): ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">No hay restaurantes registrados.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($restaurantes as $r): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($r['id']); ?></td>
                            <td><?php echo htmlspecialchars($r['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($r['precio']); ?></td>
                            <td>
                                <?php if ($r['valoraciones'] !== null): ?>
                                    <?php echo htmlspecialchars($r['valoraciones']); ?>
                                    <small>(
                                        <?php
                                        $estrellas = round($r['valoraciones']);
                                        echo str_repeat('★', $estrellas);
                                        ?>
                                        )</small>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td class="ubicacion-corta" title="<?php echo htmlspecialchars($r['ubicacion']); ?>">
                                <?php
                                $ubicacion_corta = mb_strimwidth($r['ubicacion'], 0, 30, '...');
                                echo htmlspecialchars($ubicacion_corta);
                                ?>
                            </td>
                            <td class="acciones">
                                <a href="?editar=<?php echo htmlspecialchars($r['id']); ?>" class="btn btn-success">Editar</a>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="accion" value="eliminar">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($r['id']); ?>">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este restaurante?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        // Limpiar formulario al cancelar
        const btnCancelar = document.getElementById('btn-cancelar');
        if (btnCancelar) {
            btnCancelar.addEventListener('click', function() {
                document.getElementById('form-restaurante').reset();
            });
        }
    </script>