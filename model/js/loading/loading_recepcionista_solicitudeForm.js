document.addEventListener('DOMContentLoaded', ()=>{
  let loader = document.getElementById('loader');
  // Verificar si la URL actual contiene '#solicitudes'
  if (window.location.href.includes('#solicitudes')) {
    // Muestra el loader si el fragmento '#solicitudes' está presente en la URL
    loader.classList.remove('hidden');
    // Oculta el loader después de .65s
    setTimeout(function() {
      loader.classList.add('hidden');
    }, 650);
  }
});