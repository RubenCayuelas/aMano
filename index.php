<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once('./model/php/funciones.php');
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


  <?php // include_once('./view/layout/footer_index.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="./model/js/theme/script.js"></script>
</body>
</html>