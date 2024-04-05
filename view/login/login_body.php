<!-- Para poner el modo oscuro data-bs-theme="dark" -->

<body data-bs-theme="<?php echo $_SESSION['theme'] ?>">
  <main class="w-100 m-auto">
    <form class="form-login" method="post" action="#">
      <img class="mb-4 img-fluid img_bn" src="../assets/img/logo/logo+text(1)_noBackground.png" alt="">
      <div class="d-flex justify-content-between">
        <h1 class="h3 mb-3 fw-normal">Login</h1>
        <div class="w-20px h-20px">
          <a class="btn-close d-block"></a>
        </div>
      </div>
      <div>
        <div class="form-floating mb-1">
          <input name="user" type="text" class="form-control" id="inputUser" placeholder="name@example.com">
          <label for="inputUser">Usuario</label>
        </div>
        <div class="form-floating">
          <input name="password" type="password" class="form-control" id="inputPass" placeholder="Password">
          <label for="inputPass">Contraseña</label>
        </div>

        <div id="info_text" class="text-danger fw-semibold text-center"></div>

        <div>
          <a class="d-inline-flex gap-1 " data-bs-toggle="collapse" href="#InfoCrearCuenta" role="button" aria-expanded="false" aria-controls="InfoCrearCuenta">
            ¿No tienes cuenta?
          </a>
          <div class="collapse" id="InfoCrearCuenta">
            <div class="card card-body">
              <p class="m-0">Para crear una cuenta puedes hacerlo llamandonos o en cualquiera de nuestros estudios. <a href="<!-- -->" class="d-contents">Más información.</a></p>
            </div>
          </div>
        </div>
        <div class="form-check text-start my-3">
          <input class="form-check-input" type="checkbox" name="recordarme" id="checkbox-recordarme">
          <label class="form-check-label" for="checkbox-recordarme">Recordarme</label>
        </div>
        <button name="login" class="btn btn-primary w-100 py-2" type="submit">Enviar</button>
      </div>
    </form>
  </main>
</body>