<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css"/>
  <script src="./script.js" defer></script>
  <title>Document</title>
</head>
<body>
  <main class="Main">
   <?php
    include_once("../componente/header.php");
   ?>
    <div class="noticia-container" id="noticias">
      
    </div>

    <div class="busqueda-container">
      <div class="inputNoticia">
        <label>
          Buscar noticia por titulo
        </label>
        <input id="buscarNoticia" type="text" name="titulo" placeholder="Titulo ......"/>
      </div>
      <div class="inputCrearNoticia">
        <h2>
          Tag Cloud
        </h2>
        <a href="./crear/index?t=Noticia"><button class="crearNoticia">Agregar una noticia</button></a>
        <a href="./crear/index?t=Evento"><button class="crearNoticia">Agregar un evento</button></a>
        <a href="./crear/index?t=Deporte"><button class="crearNoticia">Agregar una noticia deportiva</button></a>
      </div>
    </div>
  </main>
</body>
</html>

