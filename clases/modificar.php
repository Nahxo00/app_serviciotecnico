<?php
require '../config/conexion.php'; // Asegúrate de que esta ruta sea correcta

// Verifica si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtén los datos del formulario
    $id_reparacion = $_POST['id_reparacion'];
    $estado = $_POST['estado'];
    $dispositivo = $_POST['dispositivo'];
    $observacion = $_POST['observacion'];
    $fecha_termino = $_POST['fecha_termino'];

    // Conecta a la base de datos
    $database = new Database();
    $pdo = $database->conectar();

    // Prepara la consulta de actualización
    $sql = "UPDATE reparaciones SET estado = :estado, dispositivo = :dispositivo, observacion = :observacion, fecha_termino = :fecha_termino WHERE id_reparacion = :id_reparacion";
    $stmt = $pdo->prepare($sql);

    // Vincula los parámetros
    $stmt->bindParam(':id_reparacion', $id_reparacion, PDO::PARAM_INT);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':dispositivo', $dispositivo);
    $stmt->bindParam(':observacion', $observacion);
    $stmt->bindParam(':fecha_termino', $fecha_termino);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
}
?>
