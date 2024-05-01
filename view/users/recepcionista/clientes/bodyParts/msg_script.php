<?php
echo "
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          var add = ". json_encode($add) ." // Suponiendo que contiene true o false

          var mensajeElement = document.getElementById('mensaje');
          var mensajeTextElement = document.getElementById('mensaje-text');
          var closeButton = mensajeElement.querySelector('.btn-close');

          if (add) {
              // Si la operación fue exitosa
              mensajeTextElement.textContent = 'El cliente se ha añadido correctamente.';
              mensajeElement.classList.add('alert-success');
          } else {
              // Si hubo un error
              mensajeTextElement.textContent = 'Ha habido un error al añadir el cliente.';
              mensajeElement.classList.add('alert-danger');
          }

          // Mostrar el mensaje
          mensajeElement.style.display = 'flex';

          // Cerrar el mensaje al hacer clic en el botón de cerrar
          closeButton.addEventListener('click', function() {
              mensajeElement.style.display = 'none';
          });
      });
  </script>
";