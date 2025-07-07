let todasNoticias

window.addEventListener("load", async()=>{
  try{
    const response = await fetch("../../clases/c_noticia.php")
    if(response.ok){
      const data = await response.json()
      VisualizarNoticias(data)
      todasNoticias = data
    }
  }
  catch(e){
    console.error(e)
    document.body.innerHTML="Error al cargar datos"
  }
})
document.getElementById("buscarNoticia").addEventListener("input", (e)=>{
  const valor = e.target.value.toLowerCase().trim();
  if(valor === "") {
    VisualizarNoticias(todasNoticias)
    return
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
  })
  VisualizarNoticias(datoFiltrado)
  return
})

function VisualizarNoticias(noticias){
  const noticiaContainer = document.getElementById("noticias")
  noticiaContainer.innerHTML = ""
  noticias.map(item => {
    const titulo = document.createElement("h2")
    titulo.innerHTML = item.titulo
    const contenido = document.createElement("p")
    contenido.innerHTML = item.contenido
    const autor = document.createElement("p")
    autor.innerHTML = item.autor
    const carta = document.createElement("div")
    carta.setAttribute('class', 'noticia')
    carta.append(titulo, contenido, autor)

    noticiaContainer.appendChild(carta)
  })
}