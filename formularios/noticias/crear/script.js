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