<?php
require_once "./config/conexion.php";

$db = new Database();
$conexion = $db->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if ($id) {
        // Actualizar cliente existente
        $sql = "UPDATE clientes SET nombre = :nombre, direccion = :direccion, telefono = :telefono WHERE id = :id";
        $query = $conexion->prepare($sql);
        $query->bindParam(':id', $id);
    } else {
        // Insertar nuevo cliente
        $sql = "INSERT INTO clientes(nombre, direccion, telefono) VALUES (:nombre, :direccion, :telefono)";
        $query = $conexion->prepare($sql);
    }

    // Asignar los valores a los parámetros de la consulta
    $query->bindParam(':nombre', $nombre);
    $query->bindParam(':direccion', $direccion);
    $query->bindParam(':telefono', $telefono);

    // Ejecutar la consulta
    $query->execute();

    header('Location: cliente.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Reparaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Asegurar la carga de jQuery antes de cualquier otro script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Asegurar la carga de Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./assets/scripts.js"></script>
    <!-- Bootstrap CSS -->
<!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS (si es aplicable a tu proyecto) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- jQuery (asegúrate de cargarlo antes que cualquier otro script que lo necesite) -->
<!-- jQuery (asegúrate de cargarlo antes que cualquier otro script que lo necesite) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS (asegúrate de cargarlo después de jQuery) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

            
</head>
<body>
<div class="min-h-screen flex">
    <!-- Sidebar -->
    <div class="w-64 bg-gray-200 p-4">
        <div class="flex items-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                <path d="M3 9h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9Z"></path>
                <path d="m3 9 2.45-4.9A2 2 0 0 1 7.24 3h9.52a2 2 0 0 1 1.8 1.1L21 9"></path>
                <path d="M12 3v6"></path>
            </svg>
            <span class="ml-2 font-semibold text-lg">Taller de Reparaciones</span>
        </div>
        <nav class="flex flex-col gap-4">
            <a href="#" class="flex items-center gap-2 px-4 py-2 bg-gray-300 rounded-lg text-blue-600 hover:bg-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                </svg>
                Reparaciones
            </a>
            <a href="#" class="flex items-center gap-2 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                Clientes
            </a>
            <a href="#" class="flex items-center gap-2 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                    <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                    <path d="M10 9H8"></path>
                    <path d="M16 13H8"></path>
                    <path d="M16 17H8"></path>
                </svg>
                Cotizaciones
            </a>
        </nav>
    </div>
    <!-- Content -->
    <div class="flex-1 p-6 bg-white">
        <header class="flex items-center justify-between border-b pb-4 mb-6">
            <h1 class="text-2xl font-semibold">Clientes</h1>
            <div class="flex items-center gap-2">
                <input type="text" placeholder="Buscar reparaciones..." class="border rounded-md px-4 py-2">
            </div>

        </header>

        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="abrirClientes"><i class="fas fa-plus fa-sm text-white-50"></i> Nuevo</a>

        <style>
            .table {
                width: 100%;
                border-collapse: collapse;
            }
            .table th, .table td {
                border-bottom: 1px solid #e2e8f0; /* Color del borde */
                padding: 8px;
                text-align: center;
            }
            .table td {
                margin-bottom: 10px; /* Espacio entre filas */
            }
        </style>


        <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider center-text">ID</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider center-text">Cliente</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider center-text">Direccion</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider center-text">Telefono</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody>
        <?php
        // Preparar la consulta SQL utilizando PDO
        $query = $conexion->prepare("SELECT * FROM clientes ORDER BY id_cliente DESC");

        // Ejecutar la consulta
        $query->execute();

        // Recorrer los resultados
        while ($data = $query->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap center-text"><?php echo $data['id_cliente']; ?></td>
                <td class="px-6 py-4 whitespace-nowrap center-text"><?php echo $data['nombre']; ?></td>
                <td class="px-6 py-4 whitespace-nowrap center-text"><?php echo $data['direccion']; ?></td>
                <td class="px-6 py-4 whitespace-nowrap center-text"><?php echo $data['telefono']; ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <form method="post" action="clases/eliminar.php?accion=pro&id=<?php echo $data['id_cliente']; ?>" class="d-inline eliminar">
                        <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i></button>    
                    </form>
                    <button class="btn btn-info" type="button" onclick="editar(<?php echo $data['id_cliente']; ?>)">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
        </div>
    </div>
</div>

</body>
<div id="clientes" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gray-200">
                <h5 class="modal-title text-gray-800" id="exampleModalLabel">Nuevo Cliente</h5>
                <button type="button" class="close text-gray-800" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="nuevoProductoForm" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <textarea class="form-control" id="direccion" name="direccion" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
            $(document).ready(function() {
                $('#abrirClientes').click(function () {
                    console.log('Se hizo clic en el botón "Nuevo Cliente"');
                    $('#clientes').modal('show');
                });

            });

</script>

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
</html>
