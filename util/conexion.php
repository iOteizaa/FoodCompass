<?php
    $_servidor = "";
    $_usuario = "";
    $_contrasena = "";
    $_base_de_datos = "";

    $_conexion = new mysqli($_servidor,$_usuario,$_contrasena,$_base_de_datos)
        or die("Error de conexión: " . $_conexion->connect_error);
?>
