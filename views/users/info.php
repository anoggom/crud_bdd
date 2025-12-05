<?php

$userController = new UserController($pdo);

if (!isset($id)) {
    die("No se especificó un ID de usuario.");
}

$error = null; 

try {
    $user = $userController->getUserInfo($id);
    if (!$user) {
        $error = "Usuario no encontrado."; 
    }
} catch (ErrorException $err) {
    $error = "Ocurrió un error al obtener el usuario: " . $err->getMessage();
}

function get_role_color($role) {
    switch ($role) {
        case 'Administrador':
            return 'text-amber-500';
        case 'Editor':
            return 'text-blue-500';
        case 'Visitante':
            return 'text-emerald-500';
        default:
            return 'text-stone-500';
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script> 
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-bg': '#1A1A24', 
                        'secondary-bg': '#24242E', 
                        'text-light': '#E0E0E0', 
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-primary-bg min-h-screen p-8">
    <div class="max-w-4xl mx-auto p-8">
        <h1 class="text-3xl font-bold text-[#E0E0E0] mb-6 border-b border-[#333344] pb-3">
            Detalle del Usuario
        </h1>

        <a href="index.php" class="flex flex-row items-center space-x-2 mb-8 text-stone-200 transition duration-150">
            <img width="32" height="32" src="https://img.icons8.com/badges/48/left.png" alt="left" class="transition duration-300 ease-in-out hover:scale-125 "/>
            <span>Volver al Listado de Usuarios</span>
        </a>    
    
        <?php if ($error): ?>
            <div class="bg-red-900/30 border border-red-700 text-red-300 p-4 rounded-lg">
                <p class="font-semibold">⚠️ Ocurrió un Error</p>
                <p><?= $error ?></p>
            </div>
        <?php elseif ($user): ?>
            <div class="bg-[#24242E] rounded-lg shadow-xl p-8 border border-[#333344]">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <p class="text-sm font-medium text-stone-400 mb-1">ID del Usuario</p>
                        <p class="text-xl font-mono text-cyan-400"><?= $user['id'] ?></p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-stone-400 mb-1">Nombre Completo</p>
                        <p class="text-xl font-semibold text-[#E0E0E0]"><?= $user['name'] ?></p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-stone-400 mb-1">Correo Electrónico</p>
                        <p class="text-xl text-[#E0E0E0] break-words"><?= $user['email'] ?></p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-stone-400 mb-1">Rol</p>
                        <p class="text-xl font-bold <?= get_role_color($user['role']) ?>">
                            <?= ucfirst($user['role']) ?>
                        </p>
                    </div>
                    
                    <div class="md:col-span-2">
                        <p class="text-sm font-medium text-stone-400 mb-1">Fecha de Alta</p>
                        <p class="text-xl text-[#E0E0E0]"><?= $user['registration_date'] ?></p>
                    </div>

                </div>
            </div>
        <?php else: ?>
            <div class="bg-red-900/30 border border-red-700 text-red-300 rounded-lg">
                <p class="py-4">No se pudo cargar la información del usuario.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>