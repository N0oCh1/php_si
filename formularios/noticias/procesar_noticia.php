<?php
require_once '../../clases/ImagenUploader.php';
require_once '../../clases/c_Conexion.php';

$titulo = $_POST['titulo'];
$contenido = $_POST['contenido'];
$tipo = $_POST['tipo'];
$autor = $_POST['autor'];

try {
    $uploader = new ImagenUploader("noticias/imgesDb/");
    $resultado = $uploader->procesarImagen($_FILES['imagen']); // Procesa imagen

    $ruta_imagen = $resultado['ruta_original'];
    $tipo_imagen = $resultado['tipo'];

    $db = new mod_db();
    $datos = [
        "titulo" => $titulo,
        "contenido" => $contenido,
        "tipo_noticia" => $tipo,
        "autor" => $autor,
        "imagen" => $ruta_imagen,
        "tipo_imagen" => $tipo_imagen,
    ];

    $exito = $db->insertSeguro("noticias", $datos);

    if ($exito) {
        echo "Noticia guardada exitosamente con imagen.";
    } else {
        echo "Error al guardar en la base de datos.";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
