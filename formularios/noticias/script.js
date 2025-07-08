let todasNoticias;

// Obtener datos al cargar la página
window.addEventListener("load", async () => {
  try {
    const response = await fetch("../../clases/c_noticia.php");
    if (response.ok) {
      const data = await response.json();
      VisualizarNoticias(data);
      console.log(data);
      todasNoticias = data;
    }
  } catch (e) {
    console.error(e);
    document.body.innerHTML = "Error al cargar datos";
  }
});

// Input de noticias cuando se escribe
document.getElementById("buscarNoticia").addEventListener("input", (e) => {
  const valor = e.target.value.toLowerCase().trim();
  if (valor === "") {
    VisualizarNoticias(todasNoticias);
    return;
  }

  const datoFiltrado = todasNoticias.filter(item => {
    const titulo = item.titulo?.toLowerCase() || "";
    const contenido = item.contenido?.toLowerCase() || "";
    const autor = item.autor?.toLowerCase() || "";

    return (
      titulo.includes(valor) ||
      contenido.includes(valor) ||
      autor.includes(valor)
    );
  });

  VisualizarNoticias(datoFiltrado);
});

// Función para visualizar las noticias con miniatura
function VisualizarNoticias(noticias) {
  const noticiaContainer = document.getElementById("noticias");
  noticiaContainer.innerHTML = "";

  noticias.forEach(item => {
    const carta = document.createElement("div");
    carta.classList.add("noticia");

    // Mostrar imagen miniatura si existe
    if (item.imagen) {
      const miniatura = document.createElement("img");

      // Generar ruta de la miniatura
      //(thumb es para la miniatura, existe una versión sin el
      // thumb delante por si se quiere usar para otra cosa)
      const thumbPath = item.imagen.replace(/([^\/]+)$/, "thumb_$1");
      miniatura.src = thumbPath;
      miniatura.alt = item.titulo;
      miniatura.classList.add("miniatura");

      // Imagen clickeable para abrir la original
      miniatura.style.cursor = "pointer";
      miniatura.addEventListener("click", () => {
        window.open(item.imagen, "_blank");
      });

      carta.appendChild(miniatura);
    }

    const titulo = document.createElement("h2");
    titulo.innerHTML = item.titulo;

    const contenido = document.createElement("p");
    contenido.innerHTML = item.contenido;

    const autor = document.createElement("p");
    autor.innerHTML = `<strong>Autor:</strong> ${item.autor}`;

    carta.append(titulo, contenido, autor);
    noticiaContainer.appendChild(carta);
  });
}