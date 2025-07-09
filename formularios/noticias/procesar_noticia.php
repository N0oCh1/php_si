
<?php
$conexion = new mysqli("localhost", "root", "", "noticia");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$titulo = $_POST['titulo'];
$contenido = $_POST['contenido'];
$tipo_noticia = $_POST['tipo_noticia'];
$autor = $_POST['autor'];

$imagen_ruta = null;
$tipo_imagen = null;

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $nombre_tmp = $_FILES['imagen']['tmp_name'];
    $nombre_archivo = uniqid() . "-" . basename($_FILES["imagen"]["name"]);
    $ruta_destino = "imagesDb/" . $nombre_archivo;

    if (move_uploaded_file($nombre_tmp, $ruta_destino)) {
        $imagen_ruta = $ruta_destino;
        $tipo_imagen = $_FILES["imagen"]["type"];
    }
}

$stmt = $conexion->prepare("INSERT INTO noticias (titulo, contenido, tipo_noticia, imagen, tipo_imagen, autor) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $titulo, $contenido, $tipo_noticia, $imagen_ruta, $tipo_imagen, $autor);

if ($stmt->execute()) {
    echo "Noticia agregada correctamente. <a href='agregar_noticia.php'>Agregar otra</a>";
} else {
    echo "Error al agregar noticia: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
