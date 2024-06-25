<?php
require_once "../config/conexion.php";

// Crear una instancia de la clase Database
$db = new Database();
// Llamar al método conectar para obtener la conexión
$conexion = $db->conectar();

if (isset($_GET['accion'], $_GET['id'])) {
    $id = $_GET['id'];
    if ($_GET['accion'] == 'pro') {
        $query = $conexion->prepare("DELETE FROM clientes WHERE id_cliente = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        if ($query) {
            header('Location: ../cliente.php');
            exit; // Asegúrate de terminar la ejecución después de redirigir
        } else {
            echo "Error al eliminar cliente.";
        }
    }
}
?>
