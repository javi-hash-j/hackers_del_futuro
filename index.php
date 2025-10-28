<?php
include("conexion.php");
if (isset($_POST['eliminar_integrante']) && isset($_POST['id_a_eliminar'])) {
    $id_a_eliminar = $_POST['id_a_eliminar'];
    $sql_eliminar = "DELETE FROM hackers_del_futuro WHERE id = ?";
    $stmt = $conn->prepare($sql_eliminar);
    $stmt->bind_param("i", $id_a_eliminar);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Integrante eliminado correctamente.');</script>";
}
if (isset($_POST['editar_integrante'])) {
    $id = $_POST['id'];
    $integrantes = $_POST['integrantes'];
    $rol = $_POST['rol'];
    $no_control = $_POST['no_control'];

    if (!empty($_FILES['img']['name'])) {
        $img = $_FILES['img']['name'];
        $ruta = "img/" . basename($img);
        move_uploaded_file($_FILES['img']['tmp_name'], $ruta);
        $sql = "UPDATE hackers_del_futuro SET integrantes=?, rol=?, no_control=?, img=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $integrantes, $rol, $no_control, $img, $id);
    } else {
        $sql = "UPDATE hackers_del_futuro SET integrantes=?, rol=?, no_control=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $integrantes, $rol, $no_control, $id);
    }

    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Integrante actualizado correctamente.');</script>";
}
if (isset($_POST['agregar_integrante'])) {
    $integrantes = $_POST['integrantes'];
    $rol = $_POST['rol'];
    $no_control = $_POST['no_control'];
    $img = $_FILES['img']['name'];

    if ($img != "") {
        $ruta = "img/" . basename($img);
        move_uploaded_file($_FILES['img']['tmp_name'], $ruta);
    }

    $sql = "INSERT INTO hackers_del_futuro (integrantes, rol, no_control, img) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $integrantes, $rol, $no_control, $img);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Nuevo integrante agregado correctamente.');</script>";
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
        width: 90%;
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

    tr:nth-child(even) { background-color: #521034ff; }
    tr:nth-child(odd) { background-color: #832d6dff; }

    tr:hover { background-color: #00ff40ff; transition: 0.3s; }

    img { width: 80px; height: 80px; border-radius: 10px; }

    .form-container {
        width: 80%;
        margin: 20px auto;
        padding: 15px;
        background-color: #64bb7eff;
        border-radius: 10px;
        box-shadow: 0 0 8px rgba(0,0,0,0.2);
    }

    input, select {
        margin: 8px;
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #e28080ff;
    }

    button {
        background-color: #008CBA;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover { background-color: #006f98; }

    .eliminar-btn { background-color: #cc0000; }
    .eliminar-btn:hover { background-color: #ff3333; }
</style>
</head>
<body>

<h1>Hackers del futuro</h1>
<div class="form-container">
    <h2>Agregar nuevo integrante</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="integrantes" placeholder="Nombre del integrante" required>
        <input type="text" name="rol" placeholder="Rol" required>
        <input type="text" name="no_control" placeholder="Número de control" required>
        <input type="file" name="img" accept="image/*" required>
        <button type="submit" name="agregar_integrante">Agregar</button>
    </form>
</div>
<table>
    <tr>
        <th>Integrantes</th>
        <th>Rol</th>
        <th>No_Control</th>
        <th>Imagen</th>
        <th>Acciones</th>
    </tr>

    <?php
    $sql = "SELECT id, integrantes, rol, no_control, img FROM hackers_del_futuro";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["integrantes"]) . "</td>
                    <td>" . htmlspecialchars($row["rol"]) . "</td>
                    <td>" . htmlspecialchars($row["no_control"]) . "</td>
                    <td><img src='img/" . htmlspecialchars($row["img"]) . "' alt='Foto de " . htmlspecialchars($row["integrantes"]) . "'></td>
                    <td>
                        <!-- Formulario para editar -->
                        <form method='post' enctype='multipart/form-data'>
                            <input type='hidden' name='id' value='" . $row["id"] . "'>
                            <input type='text' name='integrantes' value='" . htmlspecialchars($row["integrantes"]) . "' required>
                            <input type='text' name='rol' value='" . htmlspecialchars($row["rol"]) . "' required>
                            <input type='text' name='no_control' value='" . htmlspecialchars($row["no_control"]) . "' required>
                            <input type='file' name='img' accept='image/*'>
                            <button type='submit' name='editar_integrante'>Editar</button>
                        </form>

                        <!-- Formulario para eliminar -->
                        <form method='post'>
                            <input type='hidden' name='id_a_eliminar' value='" . $row["id"] . "'>
                            <button type='submit' name='eliminar_integrante' class='eliminar-btn'>Eliminar</button>
                        </form>
                    </td>
                </tr>";
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