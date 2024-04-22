
const ToogleButon = document.getElementById('desplegar-aside');
const Aside = document.getElementById('aside');

const toogleClass = () => {
  // Comprueba la resolución y en base a ello añade una clase u otra eliminando la clase contraria en caso de tenerla.
  if (width >= 1024) {
    if (Aside.classList.contains('aside-show')) {
      Aside.classList.remove('aside-show');
    }
    Aside.classList.toggle('aside-hidden');
  } else {
    if (Aside.classList.contains('aside-hidden')) {
      Aside.classList.remove('aside-hidden');
    }
    Aside.classList.toggle('aside-show');
  }
}

// Resolución del documento.
let width = document.documentElement.clientWidth;

window.addEventListener('resize', () => {
  width = document.documentElement.clientWidth;
  if (width <= 900) {
  // Si la resolución es demasiado pequeña oculta por completo el menu.
    if (Aside.classList.contains('aside-hidden')) {
      Aside.classList.remove('aside-hidden');
    }
    if (Aside.classList.contains('aside-show')) {
      Aside.classList.remove('aside-show');
    }
  }
});

ToogleButon.addEventListener('click', () => {
  toogleClass();
});
