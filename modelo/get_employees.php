<?php
$conexion = mysqli_connect("localhost", "root", "", "sistema");

if($conexion === false){
    die("ERROR: No se pudo conectar. " . mysqli_connect_error());
}

$search = isset($_GET['search']) ? mysqli_real_escape_string($conexion, $_GET['search']) : '';

$sql = "SELECT * FROM users WHERE active = 1 AND (username LIKE '%$search%' OR email LIKE '%$search%' OR type LIKE '%$search%' OR phoneNumber LIKE '%$search%' OR birthdate LIKE '%$search%' OR RFC LIKE '%$search%')";
if($result = mysqli_query($conexion, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['type'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['phoneNumber'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['birthdate'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['RFC'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>
                    <button class='btn btn-danger' onclick='confirmDelete(" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . ")'>Eliminar</button>
                    <a class='btn btn-primary' href='controlador/update.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'>Actualizar</a>
                    <a class='btn btn-info' href='controlador/details.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'>Detalles</a>
                  </td>";
            echo "</tr>";
        }
        mysqli_free_result($result);
    } else{
        echo "<tr><td colspan='8'>No se encontraron empleados activos.</td></tr>";
    }
} else{
    echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function confirmDelete(id) {
    if (confirm("¿Estás seguro de que quieres eliminar este registro?")) {
        $.ajax({
            type: "POST",
            url: "controlador/controlador_eliminar_registro.php",
            data: { id: id },
            success: function(response) {
                alert(response);
                // Recargar la tabla de empleados después de la eliminación
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    }
}
</script>
