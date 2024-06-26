<?php
require_once "../config/conexion.php";

$db = new Database();
// Llamar al método conectar para obtener la conexión
$conexion = $db->conectar();

$accion = isset($_POST['accion']) ? intval($_POST['accion']) : 0;

if ($accion == 1) {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $id_clientes = intval($_POST['id']);

    if ($id > 0) {
        if ($id) {
            $sql = "UPDATE clientes SET nombre=?, direccion=?, telefono=? WHERE id_clientes=?";
            $stmt = $conexion->prepare($sql);
            $stmt->execute(array($nombre, $direccion, $telefono, $id_clientes));
        } else {
            $sql = "UPDATE clientes SET nombre=?, direccion=?, telefono=? WHERE id_clientes=?";
            $stmt = $conexion->prepare($sql);
            $stmt->execute(array($nombre, $direccion, $telefono, $id_clientes));
        }
    } else {
        $sql = "INSERT INTO clientes (nombre, direccion, telefono) VALUES (?,?,?)";
        $stmt = $conexion->prepare($sql);
        $stmt->execute(array($nombre, $direccion, $telefono));
    }


} elseif ($accion == 0) {
    if (!isset($_POST['id'])) {
        echo json_encode(['error' => 'ID no proporcionado']);
        exit();
    }

    $id = intval($_POST['id']);

    $stmt = $conexion->prepare("SELECT * FROM clientes WHERE id=?");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute(array($id));
    $row = $stmt->fetch();

    echo json_encode($row);
    exit;
}

?>
