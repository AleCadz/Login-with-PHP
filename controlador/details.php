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

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id = trim($_GET["id"]);

    $sql = "SELECT * FROM users WHERE id = ?";
    if ($stmt = mysqli_prepare($conexion, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = $id;

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $username = $row["username"];
                $email = $row["email"];
                $type = $row["type"];
                $phoneNumber = $row["phoneNumber"];
                $birthdate = $row["birthdate"];
                $RFC = $row["RFC"];
            } else {
                echo "ERROR: No se encontró ningún registro con ese ID.";
                exit();
            }
        } else {
            echo "ERROR: No se pudo ejecutar la consulta. " . mysqli_error($conexion);
        }

        mysqli_stmt_close($stmt);
    }
} else {
    echo "ERROR: ID no válido.";
    exit();
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalles del Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Detalles del Usuario</h2>
            </div>
            <div class="card-body">
                <img src="../img/<?php echo $username; ?>.jpg" class="img-fluid rounded" alt="Foto del empleado"
                    style="width: 200px; height: 200px;">
                <div class="form-group">
                    <label>Username</label>
                    <p class="form-control-static"><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <p class="form-control-static"><?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="form-group">
                    <label>Type</label>
                    <p class="form-control-static"><?php echo htmlspecialchars($type, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <p class="form-control-static"><?php echo htmlspecialchars($phoneNumber, ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                </div>
                <div class="form-group">
                    <label>Birthdate</label>
                    <p class="form-control-static"><?php echo htmlspecialchars($birthdate, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="form-group">
                    <label>RFC</label>
                    <p class="form-control-static"><?php echo htmlspecialchars($RFC, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <a href="../empleados.php" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </div>
</body>

</html>