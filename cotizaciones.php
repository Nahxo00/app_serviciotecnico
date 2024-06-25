<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cotización</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<div class="min-h-screen flex justify-center items-center bg-gray-100">
  <div class="bg-white p-8 rounded shadow-md w-full max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Crear Cotización</h1>
    <form action="guardar_cotizacion.php" method="POST" class="space-y-4">
      <div>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="cliente_id">Cliente</label>
        <select name="cliente_id" id="cliente_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
          <!-- Aquí se deben rellenar las opciones con los datos de los clientes desde la base de datos -->
          <option value="1">Olivia Martin</option>
          <option value="2">Ava Johnson</option>
          <option value="3">Michael Johnson</option>
          <option value="4">Lisa Anderson</option>
        </select>
      </div>
      <div>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="descripcion">Descripción</label>
        <input name="descripcion" id="descripcion" type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
      </div>
      <div>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="unidades">Unidades</label>
        <input name="unidades" id="unidades" type="number" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
      </div>
      <div>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="precio">Precio</label>
        <input name="precio" id="precio" type="number" step="0.01" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
      </div>
      <div>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="total">Total</label>
        <input name="total" id="total" type="number" step="0.01" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
      </div>
      <div class="flex items-center justify-between">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar Cotización</button>
      </div>
    </form>
  </div>
</div>
</body>
</html>
