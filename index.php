<?php
session_start();

if (!isset($_SESSION["id"])) {
  header("Location: login.php");
  exit();
}

$id = $_SESSION["id"];
$username = $_SESSION["username"];
$email = $_SESSION["email"];
$type = $_SESSION["type"];
$active = $_SESSION["active"];
$phoneNumber = $_SESSION["phoneNumber"];
$birthdate = $_SESSION["birthdate"];
$RFC = $_SESSION["RFC"];

include ("modelo/conexion.php");
$sql = $conexion->query("select * from users where email = '$email'");
if ($datos = $sql->fetch_object()) {
  if ($datos->active == 0) {
    session_destroy();
    header("Location: login.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bienvenido <?php echo $username; ?></title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <style>
    body {
      background-color: #f8f9fa;
      /* Color de fondo */
    }

    .card {
      border-radius: 15px;
      /* Bordes redondeados */
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
      /* Sombra */
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Inicio</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" id="AdministrarBtn" href="empleados.php">Administrar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="controlador/controlador_cerrar_sesion.php">Salir</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="card bg-dark text-white">
          <div class="card-body">
            <img src="img/<?php echo $username; ?>.jpg" class="img-fluid" alt="Foto del empleado">
            <h1 class="card-title">¡Bienvenido, <?php echo $username; ?>!</h1>
            <p class="card-text">Gracias por iniciar sesión en nuestro sitio.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script>
    $(document).ready(function () {
      <?php if ($_SESSION["type"] === "Empleado" || $_SESSION["type"] === "Ejecutivo de ventas"): ?>
        $("#AdministrarBtn").parent().hide();
      <?php endif; ?>
    });
  </script>
</body>

</html>