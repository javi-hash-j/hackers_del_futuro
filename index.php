<?php
include("conexion.php");

if (isset($_POST['eliminar_integrante']) && isset($_POST['id_a_eliminar'])) {
    $id_a_eliminar = $_POST['id_a_eliminar'];
    $sql_eliminar = "DELETE FROM hackers_del_futuro WHERE id = ?";
    $stmt = $conn->prepare($sql_eliminar);
    $stmt->bind_param("i", $id_a_eliminar); 

    if ($stmt->execute()) {
        echo "<script>alert('Integrante eliminado correctamente.');</script>";
    } else {
        echo "<script>alert('Error al eliminar el integrante: " . $conn->error . "');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hackers del futuro</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #56e0a0ff;
        margin: 40px;
    }

    h1 {
        text-align: center;
        background-color: #cc6300ff;
        color: white;
        padding: 15px;
        border-radius: 10px;
    }

    table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    th, td {
        padding: 12px;
        text-align: center;
        border: 1px solid #d9e443ff;
    }

    th {
        background-color: #d89339ff;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #521034ff;
    }

    tr:nth-child(odd) {
        background-color: #832d6dff;
    }

    tr:hover {
        background-color: #00ff40ff;
        transition: 0.3s;
    }

    img {
        width: 80px;
        height: 80px;
        border-radius: 10px;
    }
    .eliminar-form {
        margin-top: 10px;
    }

    .eliminar-form button {
        background-color: #cc0000;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
    }

    .eliminar-form button:hover {
        background-color: #ff3333;
    }
</style>
</head>
<body>

<h1>Hackers del futuro</h1>

<table>
    <tr>
        <th>integrantes</th>
        <th>Rol</th>
        <th>No_Control</th>
        <th>img</th>
        <th>Acciones</th> 
    </tr>

    <?php
    $sql = "SELECT id, integrantes, rol, no_control, img FROM hackers_del_futuro";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["integrantes"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["rol"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["no_control"]) . "</td>";
            echo "<td><img src='img/" . $row["img"] . "' alt='Foto de " . $row["integrantes"] . "' width='100' height='100' /></td>";
            echo "<td>
                      <form class='eliminar-form' method='post' action=''>
                          <input type='hidden' name='id_a_eliminar' value='" . $row["id"] . "'>
                          <button type='submit' name='eliminar_integrante'>Eliminar</button>
                      </form>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No hay datos en la tabla.</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
$conn->close();
?>