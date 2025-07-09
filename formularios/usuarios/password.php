<?php
require_once '../../clases/c_Conexion.php';
require_once '../../clases/c_RegistrarUsuario.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID de usuario no proporcionado.");
}

$conexion = new mod_db();
$pdo = $conexion->getConexion();

$usuario = new RegistrarUsuarios([], $pdo);
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clave = $_POST['clave'] ?? '';
    $confirmar = $_POST['confirmar'] ?? '';

    if (strlen($clave) < 8) {
        $mensaje = "❌ La contraseña debe tener al menos 8 caracteres.";
    } elseif ($clave !== $confirmar) {
        $mensaje = "❌ Las contraseñas no coinciden.";
    } else {
        if ($usuario->actualizarPassword($id, $clave)) {
            $mensaje = "✅ Contraseña actualizada correctamente.";
        } else {
            $mensaje = "❌ Error al actualizar la contraseña.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cambiar Contraseña</title>
    <style>
        body { font-family: Arial, sans-serif; }
        form {
            width: 400px;
            margin: auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            margin-top: 50px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label { display: block; margin-top: 10px; }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            margin-top: 15px;
            padding: 10px;
            width: 100%;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .mensaje {
            text-align: center;
            font-weight: bold;
            margin: 15px;
        }
    
    


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

    <h2 style="text-align:center;">Cambiar Contraseña</h2>

    <div class="volver">
        <a class="boton-verde" href="index.php">⬅ Volver</a>
    </div>

    <?php if ($mensaje): ?>
        <p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="clave">Nueva contraseña:</label>
        <input type="password" id="clave" name="clave" required minlength="8">

        <label for="confirmar">Confirmar contraseña:</label>
        <input type="password" id="confirmar" name="confirmar" required minlength="8">

        <button type="submit">Actualizar</button>
    </form>

  

</body>
</html>
