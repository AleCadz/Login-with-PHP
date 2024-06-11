<?php
if (isset($_POST['id']) && is_numeric($_POST['id'])) {

    $conexion = mysqli_connect("localhost", "root", "", "sistema");

    if($conexion === false){
        die("ERROR: No se pudo conectar. " . mysqli_connect_error());
    }
    
    $id = mysqli_real_escape_string($conexion, $_POST['id']);

    $stmt = $conexion->prepare("UPDATE users SET active = 0 WHERE id = ?");
    $stmt->bind_param("i", $id);

    if($stmt->execute()){
        echo "Registro eliminado correctamente.";
    } else{
        echo "ERROR: No se pudo ejecutar la consulta. " . mysqli_error($conexion);
    }

    $stmt->close();
    mysqli_close($conexion);
} else {
    echo "ID inválido.";
}
?>
