<?php
require_once '../../clases/c_Conexion.php';
require_once '../../clases/c_RegistrarUsuario.php';

$conexion = new mod_db();
$pdo = $conexion->getConexion();

$stmt = $pdo->prepare("SELECT * FROM usuarios");
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 40px;
            color: #333;
        }

        .contenedor {
            width: 90%;
            margin: 0 auto;
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
            text-align: left;
        }

        tr:hover {
            background-color: #f1f1f1;
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

        .acciones a {
            padding: 6px 10px;
            border-radius: 4px;
            margin-right: 5px;
            text-decoration: none;
            font-size: 14px;
        }

        .editar {
            background-color: #ffc107;
            color: black;
        }

        .editar:hover {
            background-color: #e0a800;
        }

        .desactivar {
            background-color: #dc3545;
            color: white;
        }

        .desactivar:hover {
            background-color: #c82333;
        }

        .activar {
            background-color: #17a2b8;
            color: white;
        }

        .activar:hover {
            background-color: #138496;
        }

        .clave {
            background-color: #6f42c1;
            color: white;
        }

        .clave:hover {
            background-color: #5936a7;
        }

        .volver {
            margin: 50px 100px;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                display: none;
            }

            td {
                position: relative;
                padding-left: 50%;
                border-bottom: 1px solid #ddd;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                font-weight: bold;
            }

            .acciones a {
                display: block;
                margin-bottom: 5px;
            }

            .volver {
                margin: 20px;
            }
        }
    </style>
</head>
<body>

    <h2>Usuarios Registrados</h2>

    <div class="volver">
        <a class="boton-verde" href="../PanelControl.php">⬅ Panel de Control</a>
    </div>

    <div class="contenedor">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td data-label="ID"><?= $usuario['id'] ?></td>
                        <td data-label="Nombre"><?= htmlspecialchars($usuario['Nombre']) ?></td>
                        <td data-label="Apellido"><?= htmlspecialchars($usuario['Apellido']) ?></td>
                        <td data-label="Usuario"><?= htmlspecialchars($usuario['Usuario']) ?></td>
                        <td data-label="Correo"><?= htmlspecialchars($usuario['Correo']) ?></td>
                        <td data-label="Activo"><?= isset($usuario['activo']) && $usuario['activo'] ? 'Sí' : 'No' ?></td>
                        <td data-label="Acciones" class="acciones">
                            <a class="editar" href="editar.php?id=<?= $usuario['id'] ?>">✏️ Editar</a>

                            <?php if (isset($usuario['activo']) && $usuario['activo']): ?>
                                <a class="desactivar" href="desactivar.php?id=<?= $usuario['id'] ?>" onclick="return confirm('¿Desactivar este usuario?')">🚫 Desactivar</a>
                            <?php else: ?>
                                <a class="activar" href="activar.php?id=<?= $usuario['id'] ?>" onclick="return confirm('¿Activar este usuario?')">✅ Activar</a>
                            <?php endif; ?>

                            <a class="clave" href="password.php?id=<?= $usuario['id'] ?>">🔒 Cambiar Clave</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
