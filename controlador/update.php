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
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $type = $_POST['type'];
    $phoneNumber = $_POST['phoneNumber'];
    $birthdate = $_POST['birthdate'];
    $RFC = $_POST['RFC'];

    // Update the record
    $sql = "UPDATE users SET username=?, email=?, type=?, phoneNumber=?, birthdate=?, RFC=? WHERE id=?";
    if ($stmt = mysqli_prepare($conexion, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssssi", $username, $email, $type, $phoneNumber, $birthdate, $RFC, $id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../empleados.php");
        } else {
            echo "ERROR: No se pudo ejecutar la actualización. " . mysqli_error($conexion);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "ERROR: No se pudo preparar la consulta. " . mysqli_error($conexion);
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
    <title>Actualizar Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Actualizar Registro</h2>
            </div>
            <div class="card-body">
                <form action="update.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control"
                            value="<?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control"
                            value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <input type="text" name="type" class="form-control"
                            value="<?php echo htmlspecialchars($type, ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phoneNumber" class="form-control"
                            value="<?php echo htmlspecialchars($phoneNumber, ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Birthdate</label>
                        <input type="date" name="birthdate" class="form-control"
                            value="<?php echo htmlspecialchars($birthdate, ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>RFC</label>
                        <input type="text" name="RFC" class="form-control"
                            value="<?php echo htmlspecialchars($RFC, ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Actualizar">
                    <a href="../empleados.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>