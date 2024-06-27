<?php
require_once "./config/conexion.php";

$db = new Database();
$conexion = $db->conectar();

// Consulta SQL para obtener los datos requeridos
$sql = "SELECT r.id_reparacion, c.nombre, c.apellido, r.estado, r.dispositivo, r.fecha_inicio
        FROM reparaciones r
        INNER JOIN clientes c ON r.id_cliente = c.id_cliente
        ORDER BY r.id_reparacion DESC";
$resultado = $conexion->query($sql);

// Consulta SQL para obtener los datos de clientes
$sqlClientes = "SELECT id_cliente, nombre, apellido FROM clientes";
$resultadoClientes = $conexion->query($sqlClientes);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fecha_inicio'])) {
    // Acceder al valor de 'fecha_inicio'
    $fecha_inicio = $_POST['fecha_inicio'];

  $id_cliente = $_POST['id_cliente'];
  $estado = $_POST['estado'];
  $dispositivo = $_POST['dispositivo'];
  $observacion = $_POST['observacion'];
  $id_reparacion = isset($_POST['id']) ? $_POST['id'] : null;

  if ($id_reparacion) {
      $sql = "UPDATE reparaciones SET id_cliente = :id_cliente, estado = :estado, dispositivo = :dispositivo, observacion = :observacion , fecha_inicio = :fecha_inicio WHERE id_reparacion = :id";
      $query = $conexion->prepare($sql);
      $query->bindParam(':id', $id_reparacion);
  } else {
      $sql = "INSERT INTO reparaciones(id_cliente, estado, dispositivo, observacion, fecha_inicio) VALUES (:id_cliente, :estado, :dispositivo, :observacion, :fecha_inicio)";
      $query = $conexion->prepare($sql);
  }
  $query->bindParam(':id_cliente', $id_cliente);
  $query->bindParam(':fecha_inicio', $fecha_inicio);
  $query->bindParam(':estado', $estado);
  $query->bindParam(':dispositivo', $dispositivo);
  $query->bindParam(':observacion', $observacion);


  $query->execute();

  header('Location: reparaciones.php');
  exit;
}
}


// Cerrar conexión
$conexion = null;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Reparaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="./assets/tailwind.config.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
      <a href="./index.php" class="flex items-center gap-2 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-300">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M3 9.5l9-7 9 7M9 22V12h6v10M21 22V10.5L12 3 3 10.5V22z"/>
        </svg>
        
        Inicio
      </a>
      <a href="#" class="flex items-center gap-2 px-4 py-2 bg-gray-300 rounded-lg text-blue-600 hover:bg-gray-400">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
          <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
        </svg>
        Reparaciones
      </a>
      <a href="./cliente.php" class="flex items-center gap-2 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-300">
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
      <a href="#" class="flex items-center gap-2 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-300">
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
  <!-- Content -->
  <div class="flex-1 p-6 bg-white">
    <header class="flex items-center justify-between border-b pb-4 mb-6">
      <h1 class="text-2xl font-semibold">Reparaciones</h1>
    </header>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white">
        <thead>
        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" required="">
                        </div>
                    </form>
                </div>
                <!-- Button de insertar datos -->
                <button class="bg-blue-500 hover:bg-blue-700 text-white p-1.5 border border-blue-700 rounded mb-2" id="abrirReparaciones">
                          <i class="fas fa-plus fa-sm"></i> Nuevo
                </button>
                <!-- --------------------------------- -->
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button type="button" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Add product
                    </button>
                    <div class="flex items-center space-x-3 w-full md:w-auto">
                        <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                            <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                            Actions
                        </button>
                        <div id="actionsDropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="actionsDropdownButton">
                                <li>
                                    <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mass Edit</a>
                                </li>
                            </ul>
                            <div class="py-1">
                                <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete all</a>
                            </div>
                        </div>
                        <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                            </svg>
                            Filter
                            <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>
                        <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                            <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Choose brand</h6>
                            <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                <li class="flex items-center">
                                    <input id="apple" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="apple" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Apple (56)</label>
                                </li>
                                <li class="flex items-center">
                                    <input id="fitbit" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Microsoft (16)</label>
                                </li>
                                <li class="flex items-center">
                                    <input id="razor" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="razor" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Razor (49)</label>
                                </li>
                                <li class="flex items-center">
                                    <input id="nikon" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="nikon" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Nikon (12)</label>
                                </li>
                                <li class="flex items-center">
                                    <input id="benq" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="benq" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">BenQ (74)</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">ID</th>
                            <th scope="col" class="px-4 py-3">Nombre</th>
                            <th scope="col" class="px-4 py-3">Dispositivo</th>
                            <th scope="col" class="px-4 py-3">Fecha</th>
                            <th scope="col" class="px-4 py-3">Estado</th>
                            <th scope="col" class="px-4 py-3">Accciones</th>
                        </tr>
                    </thead>
                    <tbody>   
                    <?php
                        // Verificar si hay resultados
                        if ($resultado->rowCount() > 0) {
                          // Inicio del bucle para mostrar cada fila de la tabla
                          while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                              echo "<tr>";
                              echo "<td class='px-4 py-3'>" . $fila['id_reparacion'] . "</td>";
                              echo "<td class='px-4 py-3'>" . $fila['nombre'] . "</td>";
                              echo "<td class='px-4 py-3'>" . $fila['dispositivo'] . "</td>";
                              echo "<td class='px-4 py-3'>" . $fila['fecha_inicio'] . "</td>";
                              echo "<td class='px-4 py-3'>" . $fila['estado'] . "</td>";
                              echo "<td class='px-4 py-3'>
                                      
                                    </td>";
                              echo "</tr>";
                          }
                        } else {
                          echo "<tr><td colspan='6' class='text-center py-4'>No hay reparaciones registradas.</td></tr>";
                        }

                      ?>
                    </tbody>
                </table>
            </div>
            <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    Showing
                    <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
                    of
                    <span class="font-semibold text-gray-900 dark:text-white">1000</span>
                </span>
                <ul class="inline-flex items-stretch -space-x-px">
                    <li>
                        <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Previous</span>
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                    </li>
                    <li>
                        <a href="#" aria-current="page" class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">100</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Next</span>
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    </section>
        </tbody>
      </table>
    </div>
  </div>
</div>



<!-- Insertar modal -->
<div id="reparaciones" tabindex="-1" aria-hidden="true" class="flex hidden overflow-y-auto overflow-x-hidden fixed z-50 inset-0 justify-center items-center align-center w-full max-h-full bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Ingresar Reparacion
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal" onclick="cerrarModal()">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Cerrar modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="nuevoReparacionesForm" class="p-4 md:p-5" method="post">
                <div class="grid gap-4 mb-4 grid-cols-2">

                    <div class="col-span-2">
                        <label for="id_cliente" class="block text-gray-700">Cliente</label>
                        <select id="id_cliente" name="id_cliente" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            <?php
                                if ($resultadoClientes->rowCount() > 0) {
                                    while ($cliente = $resultadoClientes->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='{$cliente['id_cliente']}'>{$cliente['nombre']} {$cliente['apellido']}</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>



                    <div class="col-span-2">
                          <label for="estado" class="block text-gray-700">Estado</label>
                            <select id="estado" name="estado" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                              <option value="Pendiente">Pendiente</option>
                              <option value="En Proceso">En Proceso</option>
                              <option value="Completado">Completado</option>
                            </select>
                    </div>

                    <div class="col-span-2">
                        <label for="dispositivo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dispositivo</label>
                        <input type="text" name="dispositivo" id="dispositivo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ingresar dispositivo" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="observacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observacion</label>
                        <input type="text" name="observacion" id="observacion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ingresar observacion" required="">
                    </div>
                    <div class="col-span-2">
                          <label for="fecha_inicio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de inicio</label>
                          <input type="datetime-local" name="fecha_inicio" id="fecha_inicio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Seleccionar fecha y hora" required="">
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

<script>
    $(document).ready(function() {
        $('#abrirReparaciones').click(function () {
            $('#reparaciones').removeClass('hidden');
        });
    });

    function cerrarModal() {
        $('#reparaciones').addClass('hidden');
    }   
</script>


<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
  
</html>
