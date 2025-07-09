document.getElementById("imagen").addEventListener("change", ()=>{
  
  const imagen = document.getElementById("imagen").files[0];
  
  const image = document.createElement("img");
  const container = document.getElementById("imagen-preview");
  container.innerHTML = "";
  if(imagen){
    image.src = URL.createObjectURL(imagen);
  }
  else{
    image.src = "https://placehold.co/600x400"
  }
  
  image.setAttribute("class", "imagen")  
  container.appendChild(image);

})

document.getElementById("form-create-news").addEventListener("submit", async(e)=>{
  e.preventDefault()
  const params = new URLSearchParams(window.location.search)
  const tipo_noticia = params.get("t")
  const formData = new FormData(e.target)
  formData.append("tipo", tipo_noticia)
  console.log(...formData)
  try{
    const response = await fetch("../c_procesar_noticia.php", {
    method: "POST",
    body: formData
  }).then(res=>res.json())
  console.log(response)
  }
  catch(error){
    console.log(error)
  }
})  