<?php

require_once '../../clases/c_Conexion.php';
require_once '../../clases/c_RegistrarUsuario.php';


$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID no especificado.");
}

$conexion = new mod_db();
$pdo = $conexion->getConexion();

$usuario = new RegistrarUsuarios([], $pdo);
if ($usuario->desactivarUsuario($id)) {
    header("Location: index.php");
    exit;
} else {
    echo "Error al desactivar usuario.";
}
