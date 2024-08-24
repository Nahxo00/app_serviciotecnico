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
        $sql = "UPDATE clientes SET nombre = :nombre, direccion = :direccion, telefono = :telefono WHERE id = :id";
        $query = $conexion->prepare($sql);
        $query->bindParam(':id', $id);
    } else {
        $sql = "INSERT INTO clientes(nombre, direccion, telefono) VALUES (:nombre, :direccion, :telefono)";
        $query = $conexion->prepare($sql);
    }

    $query->bindParam(':nombre', $nombre);
    $query->bindParam(':direccion', $direccion);
    $query->bindParam(':telefono', $telefono);

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="./assets/scripts.js"></script>
</head>
<body class="min-h-screen bg-gray-100 flex">
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
            <a href="./index.php" class="flex items-center gap-2 px-4 py-2 bg-gray-200 rounded-lg text-gray-600 hover:bg-gray-300 hover:no-underline">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9.5l9-7 9 7M9 22V12h6v10M21 22V10.5L12 3 3 10.5V22z"/>
                </svg>
                Inicio
            </a>
            <a href="./reparaciones.php" class="flex items-center gap-2 px-4 py-2 bg-gray-200 rounded-lg text-gray-600 hover:bg-gray-300 hover:no-underline">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                </svg>
                Reparaciones
            </a>
            <a href="#" class="flex items-center gap-2 px-4 py-2 bg-gray-300 rounded-lg text-blue-600 hover:bg-gray-400 hover:no-underline">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                Clientes
            </a>
            <a href="./cotizaciones.php" class="flex items-center gap-2 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-300 hover:no-underline">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                    <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                    <path d="M10 9H8"></path>
                    <path d="M16 13H8"></path>
                    <path d="M16 17H8"></path>
                </svg>
                Cotizaciones
            </a>
            <a href="./inventario.php" class="flex items-center gap-2 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-300 hover:no-underline">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                    <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                    <path d="M10 9H8"></path>
                    <path d="M16 13H8"></path>
                    <path d="M16 17H8"></path>
                </svg>
                Inventario
            </a>
        </nav>
    </div>
    <div class="flex-1 p-6 bg-white">
        <header class="flex items-center justify-between border-b pb-4 mb-6">
            <h1 class="text-2xl font-semibold">Clientes</h1>
            <div class="flex items-center gap-2">
                <input type="text" placeholder="Buscar clientes..." class="w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
        </header>
        <button class="bg-blue-500 hover:bg-blue-700 text-white p-1.5 border border-blue-700 rounded mb-2" id="abrirClientes">
            <i class="fas fa-plus fa-sm"></i> Nuevo
        </button>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white table-auto">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">Cliente</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">Direccion</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">Telefono</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = $conexion->prepare("SELECT * FROM clientes ORDER BY id_cliente DESC");
                    $query->execute();

                    while ($data = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-center"><?php echo $data['id_cliente']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-center"><?php echo $data['nombre']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-center"><?php echo $data['direccion']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-center"><?php echo $data['telefono']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form method="post" action="clases/eliminar.php?accion=pro&id=<?php echo $data['id_cliente']; ?>" class="inline">
                                    <button class="bg-red-600 p-2.5 rounded hover:bg-red-800 eliminar" type="submit"><i class="fas fa-trash fa-lg" style="color: white;"></i></button>

                                </form>
                                <button class="bg-green-600 p-2.5 rounded hover:bg-green-800" style="color: white;" type="button" onclick="editar(<?php echo $data['id_cliente']; ?>)">
                                    <i class="fa-regular fa-pen-to-square "></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    
<!-- <div id="clientes" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity fade-in" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="fade-in inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <div class="bg-gray-200 p-4 rounded-t-lg">
                <h5 class="text-gray-800 font-bold" id="modal-title">Nuevo Cliente</h5>
                <button type="button" class="float-right inline-flex text-gray-800" onclick="cerrarModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="mt-3 text-center sm:mt-5">
                <form id="nuevoClienteForm" method="post" class="space-y-4">
                    <input type="hidden" id="id" name="id">
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700 text-start">Nombre</label>
                        <input type="text" class="mt-1 p-2 w-full border rounded-md" id="nombre" name="nombre" required>
                    </div>
                    <div>
                        <label for="direccion" class="block text-sm font-medium text-gray-700">Direccion</label>
                        <textarea class="mt-1 p-2 w-full border rounded-md" id="direccion" name="direccion" required></textarea>
                    </div>
                    <div>
                        <label for="telefono" class="block text-sm font-medium text-gray-700">Telefono</label>
                        <input type="text" class="mt-1 p-2 w-full border rounded-md" id="telefono" name="telefono" required>
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded w-full">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>-->

<!-- Main modal -->
<div id="clientes" tabindex="-1" aria-hidden="true" class="flex hidden overflow-y-auto overflow-x-hidden fixed z-50 inset-0 justify-center items-center align-center w-full max-h-full bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Ingresar Cliente
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal" onclick="cerrarModal()">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Cerrar modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="nuevoClienteForm" class="p-4 md:p-5" method="post">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Cliente</label>
                        <input type="text" name="nombre" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ingresar nombre" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Direccion</label>
                        <input type="text" name="direccion" id="direccion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ingresar direccion" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefono</label>
                        <input type="text" name="telefono" id="telefono" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ingresar telefono" required="">
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-full">
                    Guardar
                </button>
            </form>
        </div>
    </div>
</div> 
</body>

<div id="borrar-cliente" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#abrirClientes').click(function () {
            $('#clientes').removeClass('hidden');
        });
    });

    function cerrarModal() {
        $('#clientes').addClass('hidden');
    }

    function editar(id) {
        // Lógica para editar cliente
    }

    
</script>
</html>
