<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

// Eliminar la cookie de "Recordar contraseña"
if (isset($_COOKIE['remember_token'])) {
    setcookie(
        'remember_token',
        '',
        [
            'expires' => time() - 3600,
            'path' => '/',
            'domain' => '',  // Dominio
            'secure' => true,              // Solo HTTPS
            'httponly' => true             // No accesible por JS
        ]
    );

    // Si hay una sesión activa, limpiar el token en la base de datos
    if (isset($_SESSION['usuario_id'])) {
        require('../../util/conexion.php');

        $sql = "UPDATE usuarios SET token_remember = NULL, token_expira = NULL WHERE id = ?";
        $stmt = $_conexion->prepare($sql);
        $stmt->bind_param("i", $_SESSION['usuario_id']);
        $stmt->execute();
    }
}

// Destruir completamente la sesión
$_SESSION = array();

// Destruir la cookie de sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        [
            'expires' => time() - 42000,
            'path' => $params["path"],
            'domain' => '',  // Dominio
            'secure' => true,              // Solo HTTPS
            'httponly' => $params["httponly"],
            'samesite' => 'Strict'
        ]
    );
}

// Destruir la sesión y redireccionar
session_destroy();
header("Location: ../index.php");
exit;
