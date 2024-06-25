<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-auth.js"></script>
    
</head>
<body class="flex justify-center items-center h-screen bg-gray-900 px-4 md:px-0">

<div class="border text-card-foreground bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
    <div class="flex flex-col space-y-1.5 p-6">
        <h3 class="whitespace-nowrap tracking-tight text-2xl font-bold text-center mb-4 text-gray-50">
            Iniciar sesión
        </h3>
    </div>
    <div class="p-6">
        <form class="space-y-4" method="POST" action="login.php">
            <div>
                <label class="text-sm leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 block font-medium mb-2 text-gray-300" for="username">
                    Nombre de Usuario
                </label>
                <input class="flex h-10 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-full border-2 border-gray-600 rounded-md p-2 bg-gray-700 text-gray-300" id="username" name="username" placeholder="Usuario" type="user" required>
            </div>
            <div>
                <label class="text-sm leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 block font-medium mb-2 text-gray-300" for="password">
                    Contraseña
                </label>
                <input class="flex h-10 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-full border-2 border-gray-600 rounded-md p-2 bg-gray-700 text-gray-300" id="password" name="password" placeholder="••••••••" type="password" required>
            </div>
            <div class="grid grid-cols-1 gap-4">
                <button class="inline-flex items-center justify-center whitespace-nowrap text-sm ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 bg-blue-600 hover:bg-blue-700 text-gray-50 font-medium py-2 px-4 rounded-md" type="submit">
                    Iniciar sesión
                </button>
            </div>
        </form>
    </div>
    <div class="flex items-center p-6 text-center mt-4">
        <a class="text-blue-600 hover:text-blue-700 font-medium" href="#">
            ¿Olvidaste tu contraseña?
        </a>
    </div>
</div>
</body>
</html>