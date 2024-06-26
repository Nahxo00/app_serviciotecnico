<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Reparaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
      <div class="flex items-center gap-2">
        <input type="text" placeholder="Buscar reparaciones..." class="border rounded-md px-4 py-2">
        <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">+</button>
      </div>
    </header>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white">
        <thead>
          <tr>
            <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Numero</th>
            <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Cliente</th>
            <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Dispositivo</th>
            <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fecha</th>
            <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Estado</th>
            <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Acciones</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr>
            <td class="px-6 py-4 whitespace-nowrap">#3210</td>
            <td class="px-6 py-4 whitespace-nowrap">Olivia Martin</td>
            <td class="px-6 py-4 whitespace-nowrap">iPhone 12</td>
            <td class="px-6 py-4 whitespace-nowrap">20 de junio, 2023</td>
            <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Reparado</span></td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <a href="#" class="text-blue-600 hover:text-blue-900">Editar</a>
            </td>
          </tr>
          <!-- Repite las filas según sea necesario -->
          <tr>
            <td class="px-6 py-4 whitespace-nowrap">#3209</td>
            <td class="px-6 py-4 whitespace-nowrap">Ava Johnson</td>
            <td class="px-6 py-4 whitespace-nowrap">Samsung Galaxy S21</td>
            <td class="px-6 py-4 whitespace-nowrap">15 de mayo, 2023</td>
            <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">En proceso</span></td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <a href="#" class="text-blue-600 hover:text-blue-900">Editar</a>
            </td>
          </tr>
          <tr>
            <td class="px-6 py-4 whitespace-nowrap">#3204</td>
            <td class="px-6 py-4 whitespace-nowrap">Michael Johnson</td>
            <td class="px-6 py-4 whitespace-nowrap">MacBook Pro</td>
            <td class="px-6 py-4 whitespace-nowrap">3 de abril, 2023</td>
            <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Pendiente</span></td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <a href="#" class="text-blue-600 hover:text-blue-900">Editar</a>
            </td>
          </tr>
          <tr>
            <td class="px-6 py-4 whitespace-nowrap">#3203</td>
            <td class="px-6 py-4 whitespace-nowrap">Lisa Anderson</td>
            <td class="px-6 py-4 whitespace-nowrap">iPad Pro</td>
            <td class="px-6 py-4 whitespace-nowrap">15 de marzo, 2023</td>
            <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Reparado</span></td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
  
</html>
