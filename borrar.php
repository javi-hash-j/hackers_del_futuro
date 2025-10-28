<?php
include("conexion.php");
if (isset($_POST['id_a_borrar'])) {
    $id_a_borrar = mysqli_real_escape_string($conn, $_POST['id_a_borrar']);
    $sql = "DELETE FROM hackers_del_futuro WHERE no_control = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $id_a_borrar);
        if ($stmt->execute()) {
            header("Location: index.php?status=success");
        } else {
            header("Location: index.php?status=error_db");
        }
        $stmt->close();
    } else {
        header("Location: index.php?status=error_prep");
    }
} else {
    header("Location: index.php?status=error_no_id");
}
$conn->close();
?>