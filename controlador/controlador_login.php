<?php
session_start();

if (!empty($_POST["btningresar"])) {
    if (!empty($_POST["email"]) && !empty($_POST["password"])) {

        $email = $_POST["email"];
        $password = $_POST["password"]; 
        $stmt = $conexion->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $datos = $result->fetch_object();

            if (password_verify($password, $datos->password)) {
                if ($datos->active == 1) {
                    session_regenerate_id(true);
                    
                    $_SESSION["id"]= $datos->id;
                    $_SESSION["username"]= $datos->username;
                    $_SESSION["email"]= $datos->email;
                    $_SESSION["type"]= $datos->type;
                    $_SESSION["active"]= $datos->active;
                    $_SESSION["phoneNumber"]= $datos->phoneNumber;
                    $_SESSION["birthdate"]= $datos->birthdate;
                    $_SESSION["RFC"]= $datos->RFC;

                    header("location: index.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Usuario inactivo</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Información incorrecta</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Usuario no encontrado</div>";
        }
        
        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Falta llenar campos</div>";
    }
}
?>
