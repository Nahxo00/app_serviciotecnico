<?php
require_once "../config/conexion.php";

// Crear una instancia de la clase Database
$db = new Database();
// Llamar al método conectar para obtener la conexión
$conexion = $db->conectar();

if (isset($_GET['accion'], $_GET['id'])) {
    $id_reparacion = $_GET['id'];
    if ($_GET['accion'] == 'pro') {
        $query = $conexion->prepare("DELETE FROM reparaciones WHERE id_reparacion = :id");
        $query->bindParam(':id', $id_reparacion);
        $query->execute();
        if ($query->rowCount() > 0) {
            header('Location: ../reparaciones.php');
            exit; // Asegúrate de terminar la ejecución después de redirigir
        } else {
            echo "Error al eliminar registro.";
        }
    }
}
?>
