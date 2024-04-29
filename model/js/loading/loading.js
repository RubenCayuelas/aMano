document.addEventListener('DOMContentLoaded', ()=>{
  let loader = document.getElementById('loader');
  // Muestra el loader
  loader.classList.remove('hidden');
  // Oculta el loader después de .65s
  setTimeout(function() {
    loader.classList.add('hidden');
  }, 650);
});