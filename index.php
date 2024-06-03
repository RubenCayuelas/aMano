<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once('./models/php/funciones.php');
$themeState = session_theme();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fotografía a Mano - Inicio</title>
  <link rel="shortcut icon" href="./assets/img/logo/logo(2).png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="./view/css/styles.css">
</head>

<body data-bs-theme="<?php echo $_SESSION['theme'] ?>" style="height: 100vh;">
  <?php include_once('./view/layout/header_index.php'); ?>

  <main class="main w-100 m-0 mt-5">
    <?php
      include_once('./models/php/db.php');

      include('./models/php/trabajo.php');
      include('./models/php/foto.php');
      include('./models/php/clientes.php');
      include('./models/php/servicios.php');
      $trabajos = new Trabajo();
      $fotos = new Foto();
      $clientes = new Clientes();
      $servicios = new Servicios();

      $trabajo = $trabajos->getLastPublicWork();
      $foto = $trabajo != [] && $trabajo != null ? $fotos->getPreviewForTrabajo($trabajo['id']) : null;
      
      if ($foto != [] && $foto != null) {
        $cliente = $clientes->getCliente($trabajo['id_cliente']);
        $url = "&quot;./assets/img/trabajos/$cliente[nick]/$trabajo[nombre]/".$foto[0]['foto']."&quot;";

        $altura = '85vh';
        $style = 'style="width: 100%; height: 100%; background-image:url(' . $url . '); background-repeat: no-repeat; background-size: cover; background-attachment:fixed; color: white"';
      } else {
        $altura = '50vh';
        $style = 'style="width: 100%; height: 100%; background-color: #8a712e40; color: white"';
      }
      echo '<section style="width: 100%; height: ' . $altura . ';">
              <div ' . $style . '>
                <div style="height: 100%; background-color: #00000045; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                  <h1 class="w-75 w-sm-50">
                    <img src="./assets/img/logo/logo+text_noBackground.png" class="w-100" alt="Fotografía aMano">
                  </h1>
                  <p>Texto de ejemplo</p>
                </div>
              </div>
            </section>';
    ?>

    <section id="about_us" class="container pt-5">
      <div class="row">
        <h2 class="mt-3">¿Quiénes somos?</h2>
        <hr class="w-75">
        <div class="w-95 mx-auto">
          <p class="mb-2 text-justify">
            Bienvenidos a Fotografías aMano, una empresa de fotografía dedicada a capturar momentos únicos y convertirlos en recuerdos eternos. Con una trayectoria de años en la industria, nos hemos consolidado como un referente en el arte de la fotografía, combinando talento, creatividad y tecnología de vanguardia.
          </p>
          <div class="mt-2 ms-4">
            <h4 class="d-block mb-0 text-start">Nuestra Historia</h4>
            <hr class="w-25 my-2">
          </div>
          <p class="mb-2 text-justify">
            Fotografías aMano nació de la pasión de un grupo de fotógrafos que compartían una visión: crear imágenes que hablen por sí solas. Desde nuestros inicios, hemos crecido y evolucionado, expandiendo nuestra presencia con numerosos estudios equipados con lo último en tecnología fotográfica. Cada uno de nuestros estudios está diseñado para ofrecer la mejor experiencia, tanto para sesiones fotográficas profesionales como para aquellos momentos especiales que merecen ser inmortalizados.
          </p>
          <div class="mt-3 ms-4">
            <h4 class="d-block mb-0 text-start">Nuestra Filosofía</h4>
            <hr class="w-25 my-2">
          </div>
          <p class="mb-2 text-justify">
            Creemos que cada fotografía cuenta una historia y nuestro objetivo es asegurarnos de que esas historias sean contadas de la manera más hermosa y auténtica posible. Nos enorgullecemos de nuestro enfoque personalizado, trabajando estrechamente con cada cliente para entender sus visiones y expectativas. En fotografías aMano, cada imagen es tratada con el máximo cuidado y dedicación, garantizando resultados que superen las expectativas.
          </p>
          <div class="mt-2 ms-4">
            <h4 class="d-block mb-0 text-start">Compromiso con la Calidad</h4>
            <hr class="w-25 my-2">
          </div>
          <p class="mb-2 text-justify">
            En fotografías aMano, la calidad es nuestra máxima prioridad. Utilizamos equipos de última generación y técnicas avanzadas para garantizar que cada fotografía refleje la esencia del momento capturado. Nuestro compromiso con la excelencia nos ha permitido ganar la confianza y satisfacción de nuestros clientes a lo largo de los años.
          </p>
        </div>
      </div>
    </section>

    <section id="our_services" class="container pt-5">
      <div class="row">
        <div class="services col d-flex flex-column align-items-end">
          <h2 class="mt-3">Nuestros Servicios</h2>
          <hr class="w-75">
          <div class="row">
            <?php
              $servicios = $servicios->listarServicios();
              for ($i = 0; $i < count($servicios); $i++) {
                $imagen = "&quot;./assets/img/services/" . $servicios[$i]['img'] . "&quot;";
                echo '<article class="col-md-5 mx-2 p-0 mb-3" style="background-image:url(' . $imagen . '); background-repeat: no-repeat; background-size: cover;">
                        <div>
                          <h3>' . $servicios[$i]["nombre"] . '</h3>
                          <p class="pe-5">' . $servicios[$i]["descripcion"] . '</p>
                          <div>
                            <form action=".#" method="post">
                              <button type="submit" name="ver_mas" value="' . $servicios[$i]["id"] . '" class="btn btn-outline-light bs-gray-500">Ver más</button>
                            </form>
                          <div>
                        </div>
                      </article>';
              }
            ?>
          </div>
        </div>
      </div>
    </section>
    
    <!-- <section id="photographers" class="container pt-5">
      <div class="row">
        <div class="col">
          <h2 class="mt-3">Fotografos destacados</h2>
          <hr class="w-75">
          <div></div>
        </div>
      </div>
    </section> -->

  </main>
  <?php include_once('./view/layout/footer_index.html'); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./models/js/theme.js"></script>
</body>

</html>