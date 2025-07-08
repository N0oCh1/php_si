<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css"/>
  <script src="script.js" defer></script>
</head>
<body>
      <?php
      include_once("../../componente/header.php");
    ?>
  <main>

    <div class="imagen-preview" id="imagen-preview">
      <img src="https://placehold.co/600x400" alt="test" class="imagen"/>
    </div>

    <form id="form-create-news">
        <div class="inputForm">
          <label>
            Ingrese el titulo de la noticia
          </label>
          <input type="text" name="titulo" id="titulo" placeholder="Titulo de la noticia..." required/>
        </div>
        <div class="inputForm">
          <label>
            ingrese el contenido 
          </label>
          <textarea name="contenido" id="contenido" cols="30" rows="10" placeholder="Contenido de la noticia..." required></textarea>
        </div>
        <div class="inputForm">
          <label>
            ingrese la imagen de la noticia
          </label>
          <input type="file" name="imagen" id="imagen" accept="image/png, image/jpeg" required/>
        </div>
        <input type="submit" value="Crear noticia"/>
    </form>

  </main>
</body>
</html>