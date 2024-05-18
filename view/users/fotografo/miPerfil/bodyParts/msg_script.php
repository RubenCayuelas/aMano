<?php
echo "
  <script>
      document.addEventListener('DOMContentLoaded', () => {
          let result = ". json_encode($result) ." // true o false

          let mensajeElement = document.getElementById('mensaje');
          let mensajeTextElement = document.getElementById('mensaje-text');
          let closeButton = mensajeElement.querySelector('.btn-close');

          if (result) {
              // Si la operación fue exitosa
              mensajeTextElement.textContent = ". json_encode($msg) .";
              mensajeElement.classList.add('alert-success');
          } else {
              // Si hubo un error
              mensajeTextElement.textContent = ". json_encode($msgError) .";
              mensajeElement.classList.add('alert-danger');
          }

          // Mostrar el mensaje
          mensajeElement.style.display = 'flex';

          // Cerrar el mensaje al hacer clic en el botón de cerrar
          closeButton.addEventListener('click', () => {
              mensajeElement.style.display = 'none';
          });
      });
  </script>
";