document.addEventListener("DOMContentLoaded", () => {
  fetch("https://api.quotable.io/random")
    .then(response => response.json())
    .then(data => {
      const frase = data.content;
      traducir(frase, 'en', 'es')
        .then(traduccion => {
          document.getElementById("saludo").innerText = traduccion;
        })
        .catch(error => {
          console.error("Error en la traducción:", error);
          document.getElementById("saludo").innerText = "No se pudo cargar el saludo.";
        });
    })
    .catch(error => {
      console.error("Error al obtener el saludo:", error);
      document.getElementById("saludo").innerText = "No se pudo cargar el saludo.";
    });

  document.getElementById("buttonCloseSaludo").addEventListener("click", () => {
    closeSaludo();
  });
});

async function traducir(texto, idiomaOrigen, idiomaDestino) {
  const response = await fetch(`https://api.mymemory.translated.net/get?q=${texto}&langpair=${idiomaOrigen}|${idiomaDestino}`);
  const data = await response.json();
  const traduccionIntermedia = data.responseData.translatedText;
  return traduccionIntermedia
}


function closeSaludo() {
  document.getElementById("saludoAPI").style.display = "none";
}