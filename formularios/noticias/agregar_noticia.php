
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Noticia</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Agregar Nueva Noticia</h2>
  <form action="procesar_noticia.php" method="post" enctype="multipart/form-data">
    <label>Título:</label><br>
    <input type="text" name="titulo" required><br><br>

    <label>Contenido:</label><br>
    <textarea name="contenido" rows="5" cols="40" required></textarea><br><br>

    <label>Tipo de Noticia:</label><br>
    <input type="text" name="tipo_noticia" required><br><br>

    <label>Autor:</label><br>
    <input type="text" name="autor" required><br><br>

    <label>Imagen:</label><br>
    <input type="file" name="imagen"><br><br>

    <input type="submit" value="Publicar Noticia">
  </form>
</body>
</html>
