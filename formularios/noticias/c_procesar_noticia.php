<?php
require_once '../../clases/c_ImagenUploader.php';
require_once '../../clases/c_Conexion.php';

require_once '../../clases/SanitizarEntrada.php';

$sanitizar = new SanitizarEntrada();
session_start();
//archivo temporal hasta que Roy implemente el formulario real
$titulo = $sanitizar::limpiarCadena($_POST['titulo']);
$contenido = $sanitizar::limpiarCadena($_POST['contenido']);
$tipo = $sanitizar::limpiarCadena($_POST['tipo']);

if($_SESSION["Usuario"] == null){
    header('Content-type: application/json; charset=utf-8');
    http_response_code(401);
    json_encode([
        "error"=>"no estas autenticado"
    ]);
    exit;
};
$autor = $sanitizar::limpiarCadena($_SESSION['Usuario']);

try {
    $uploader = new ImagenUploader("imagesDb/");
    // Procesa imagen
    $resultado = $uploader->procesarImagen($_FILES['imagen']); 

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
    header('Content-type: application/json; charset=utf-8');
    if ($exito) {
        http_response_code(200);
        echo json_encode([
            "menssage" => "se gurado exitosamente"
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            "error" => "Ops hubo un error"
        ]);
    }

} catch (Exception $e) {
    http_response_code(400);
        echo json_encode([
            "error" => $e->getMessage()
        ]); 
    }