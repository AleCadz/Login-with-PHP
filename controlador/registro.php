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
include ("../modelo/conexion.php");
if ($type == "Ejecutivo de ventas" || $type == "Empleado") {
    header("Location: ../index.php");
}
$sql = $conexion->query("select * from users where email = '$email'");
if ($datos = $sql->fetch_object()) {
    if ($datos->active == 0) {
        session_destroy();
        header("Location: login.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $type = $_POST["type"];
    $phoneNumber = $_POST["phoneNumber"];
    $birthdate = $_POST["birthdate"];
    $RFC = $_POST["RFC"];
    $active = isset($_POST["active"]) ? 1 : 0;

    // Hash del password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Procesar la imagen
    $img_name = $_FILES['userImage']['name'];
    $img_tmp = $_FILES['userImage']['tmp_name'];
    $img_size = $_FILES['userImage']['size'];
    $img_error = $_FILES['userImage']['error'];
    $img_folder = "../img/";

    if ($img_error === 0) {
        // Nombre de archivo igual al nombre de usuario
        $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_destination = $img_folder . $username . ".jpg"; // Nombre de archivo igual al nombre de usuario

        if ($img_extension == 'jpg' || $img_extension == 'jpeg') {
            move_uploaded_file($img_tmp, $img_destination);
        } else {

            $img = imagecreatefromstring(file_get_contents($img_tmp));
            imagejpeg($img, $img_destination, 80); // Calidad de compresión 80

            imagedestroy($img);
        }
    } else {
        echo "Error al subir la imagen.";
    }

    $sql = $conexion->prepare("INSERT INTO users (username, password, email, type, phoneNumber, birthdate, RFC, active, imgSrc) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("sssssssss", $username, $hashed_password, $email, $type, $phoneNumber, $birthdate, $RFC, $active, $img_destination);

    if ($sql->execute()) {
        header("Location: ../empleados.php");
        exit();
    } else {
        echo "Error: " . $sql->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Registrar Usuario</h3>
                    </div>
                    <div class="card-body">
                        <form action="registro.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="username" class="form-label">Nombre de usuario</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Tipo de usuario</label>
                                <select class="form-control" id="type" name="type" required>
                                    <option value="Admin">Admin</option>
                                    <option value="Ejecutivo de ventas">Ejecutivo de ventas</option>
                                    <option value="Empleado">Empleado</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Número de teléfono</label>
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
                            </div>
                            <div class="mb-3">
                                <label for="birthdate" class="form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                            </div>
                            <div class="mb-3">
                                <label for="RFC" class="form-label">RFC</label>
                                <input type="text" class="form-control" id="RFC" name="RFC" required>
                            </div>
                            <div class="mb-3">
                                <label for="userImage" class="form-label">Imagen de perfil</label>
                                <input type="file" class="form-control" id="userImage" name="userImage">
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="active" name="active">
                                <label class="form-check-label" for="active">Activo</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Registrar</button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="../empleados.php" class="btn btn-secondary">Volver a la lista de empleados</a>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>