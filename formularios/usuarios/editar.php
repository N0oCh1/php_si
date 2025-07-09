<?php
require_once '../../clases/c_Conexion.php';
require_once '../../clases/c_RegistrarUsuario.php';

$conexion = new mod_db();
$pdo = $conexion->getConexion();

$mensaje = '';
$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID de usuario no especificado.");
}

// Instanciar con datos vacíos inicialmente
$usuario = new RegistrarUsuarios([], $pdo);

// Si se envió el formulario, actualizamos el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'name'     => $_POST['nombre'] ?? '',
        'lastName' => $_POST['apellido'] ?? '',
        'email'    => $_POST['correo'] ?? '',
        'user'     => $_POST['usuario'] ?? '',
    ];

    $usuario = new RegistrarUsuarios($datos, $pdo); // Reinstanciar con los nuevos datos

    if ($usuario->actualizarUsuario($id, $datos)) {
        $mensaje = "✅ Usuario actualizado correctamente.";
    } else {
        $mensaje = "❌ Error al actualizar el usuario.";
    }
}

// Método adicional que debes implementar:
$datosUsuario = $usuario->obtenerPorId($id);

if (!$datosUsuario) {
    die("Usuario no encontrado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <style>
        body { font-family: Arial, sans-serif; }
        form { width: 400px; margin: auto; background: #f2f2f2; padding: 20px; border-radius: 8px; }
        label { display: block; margin-top: 10px; }
        input { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px; width: 100%; background-color: #4CAF50; color: white; border: none; border-radius: 5px; }
        .mensaje { text-align: center; font-weight: bold; margin: 15px; }

        .boton-verde {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .boton-verde:hover {
            background-color: #218838;
        }
        .volver {
            margin: 50px 100px;
        }

    </style>
</head>
<body>

    <h2 style="text-align:center;">Editar Usuario</h2>

    <div class="volver">
        <a class="boton-verde" href="index.php">⬅ Volver</a>
    </div>

    <?php if ($mensaje): ?>
        <p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($datosUsuario['Nombre']) ?>" required>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" value="<?= htmlspecialchars($datosUsuario['Apellido']) ?>" required>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" value="<?= htmlspecialchars($datosUsuario['Correo']) ?>" required>

        <label for="usuario">Nombre de Usuario:</label>
        <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($datosUsuario['Usuario']) ?>" required>

        <button type="submit">Guardar Cambios</button>
    </form>

</body>
</html>
