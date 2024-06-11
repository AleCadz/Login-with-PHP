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
if ($type == "Ejecutivo de ventas" || $type == "Empleado") {
    header("Location: index.php");
}
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
    <title>Consulta de Empleados</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/empleadosStyles.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Inicio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
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

    <div class="container">
        <h2 class="mt-5 mb-4">Consulta de Empleados</h2>
        <a href="controlador/registro.php" class="btn btn-success mb-4">Registrar Usuario</a>
        <div id="employeeTable" class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Lista de empleados -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/scriptEmpleados.js"></script>

</body>

</html>