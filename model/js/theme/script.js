
// Cambia el color del tema al seleccionado

const theme = document.getElementById('theme');
const body = document.getElementsByTagName('body')[0];

theme.addEventListener('change', ()=>{
  if (theme.checked) {
    body.setAttribute('data-bs-theme', 'dark');
    document.cookie = "theme=dark";
  } else {
    body.setAttribute('data-bs-theme', 'light');
    document.cookie = "theme=light";
  }
});


// Experimentar con los colores por defecto del sistema
// if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
//   body.setAttribute('data-bs-theme', 'dark');
//   document.cookie = "theme=dark";
// } else {
//   body.setAttribute('data-bs-theme', 'light');
//   document.cookie = "theme=light";
// }
