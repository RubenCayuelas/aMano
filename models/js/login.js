
document.querySelector('a.btn-close').addEventListener("click", () => {
  window.location.href = window.location.href.replace("controller/controlador_login.php", "index.php");
});