<?php
    
include('./config/database.php');
include('./controllers/UserController.php');

ob_start();

$users = [];
$db_error = null;

try {
    $pdo = getDbConnection();
    $userController = new UserController($pdo);
    $users = $userController->getAllUsers();
} catch (Exception $e) {
    error_log("Error de base de datos: " . $e->getMessage());
    $db_error = "❌ No fue posible conectar con la base de datos.";
    $pdo = null;
}


if (isset($_GET['action']) && $_GET['action'] === 'user_show' && isset($_GET['id'])) {
    $id = (int)$_GET['id']; 
    include __DIR__ . '/views/users/info.php'; 
    exit; 
}


if (isset($_GET['action']) && $_GET['action'] === 'user_show' && isset($_GET['id'])) {
    $id = (int)$_GET['id']; 
    include __DIR__ . '/views/users/info.php'; 
    exit; 
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>CRUD de usuarios con PHP</title>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
        
        body {
            font-family: "Montserrat", sans-serif;
        }
        
        td, th{
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
            padding-left: 1rem;
            padding-right: 1rem;
        }
    </style>
</head>
<body class="bg-[#111110] text-white">
    <h1 class="text-3xl font-bold underline text-center my-4">
        <a href="index.php">Gestión básica de usuarios con BDD</a>
    </h1>
    <div class="flex flex-col mx-16">
        <h3 class="text-xl font-semibold my-8">
        Lista de usuarios registrados
        </h3>
        <div class="container h-full">
        
            <button id="openModalBtn" class="text-stone-200 hover:text-stone-400 border-2 px-2 py-1 rounded mb-4 inline-block">
                Añadir usuario
            </button>

            <div id="userModal" class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 hidden">
                <div class="bg-[#24242E] rounded-lg p-8 shadow-lg relative w-full max-w-2xl">
                    <button id="closeModalBtn" class="absolute top-2 right-2 text-white text-xl font-bold hover:text-red-400">&times;</button>
                    <?php include './views/users/create.php'; ?>
                </div>
            </div>

            <div id="modalEditUser" class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 hidden" style="display:none;">
                <div class="bg-[#24242E] rounded-lg p-8 shadow-lg relative w-full max-w-2xl">
                    <button id="closeModalEditUser" class="absolute top-2 right-2 text-white text-xl font-bold hover:text-red-400">&times;</button>
                    <?php include './views/users/edit.php'; ?>
                </div>
            </div>

            <div id="deleteModal" class="fixed inset-0 bg-black/70 flex items-center justify-center z-99" style="display:none;">
                <?php include 'views/users/delete.php'; ?>
            </div>

            <div class="overflow-y-auto mb-10 max-h-[500px] rounded-lg relative">
                <?php if ($db_error): ?>
                    <div class="bg-[#24242E] my-6 p-4 rounded-lg text-center text-red-400 font-semibold border border-red-400/50">
                        <?= $db_error ?>
                    </div>
                    
                <?php else: ?>
                    <table class="min-w-full my-4 w-auto table-auto border-collapse">
                        <thead class="sticky top-0 z-[1] bg-[#1E1E2F] text-[#E0E0E0]">
                            <tr class="text-center border-b border-[#333344]">
                                <th class="bg-[#24242E] py-2 px-4 w-12">ID</th>
                                <th class="bg-[#24242E] py-2 px-4">Nombre</th>
                                <th class="bg-[#24242E] py-2 px-4">Email</th>
                                <th class="bg-[#24242E] py-2 px-4">Rol</th>
                                <th class="bg-[#24242E] py-2 px-4">Registro</th>
                                <th class="bg-[#24242E] py-2 px-4 w-16">Ver</th>
                                <th class="bg-[#24242E] py-2 px-4 w-16">Editar</th>
                                <th class="bg-[#24242E] py-2 px-4 w-16">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $index => $fila): ?>
                                    <?php $bg_color = ($index % 2 === 0) ? 'bg-[#1A1A24]' : 'bg-[#24242E]'; ?>
                                    <tr class="text-center text-[#E0E0E0] text-center <?= $bg_color ?>">
                                        <td class="py-2 px-4 font-mono"><?= htmlspecialchars($fila["id"]) ?></td>
                                        <td class="py-2 px-4 font-medium"><?= htmlspecialchars($fila["name"]) ?></td>
                                        <td class="py-2 px-4"><?= htmlspecialchars($fila["email"]) ?></td>
                                        <td class="py-2 px-4 font-semibold"> 
                                            <?php
                                                $role = $fila["role"];
                                                $roleColor = match($role) {
                                                    'Administrador' => 'text-amber-500',
                                                    'Editor'        => 'text-blue-500',
                                                    'Visitante'     => 'text-emerald-500',
                                                    default         => 'text-stone-500',
                                                };
                                            ?>
                                            <span class="<?= $roleColor ?>">
                                                <?= htmlspecialchars($role) ?>
                                            </span>
                                        </td>
                                        <td class="py-2 px-4 text-stone-400"><?= htmlspecialchars(date('d/m/Y', strtotime($fila["registration_date"]))) ?></td>
                                        
                                        <td class="py-2 px-4">
                                            <a href="index.php?action=user_show&id=<?= urlencode($fila["id"]) ?>" 
                                                class="font-semibold px-2 py-1 rounded transition 
                                                bg-indigo-700/60 hover:bg-indigo-700 text-white block w-full cursor-pointer"
                                            >
                                                🔎
                                            </a>
                                        </td>

                                        <td class="py-2 px-4">
                                            <a href="#" 
                                                class="edit-btn font-semibold px-2 py-1 rounded transition bg-violet-900/60 hover:bg-violet-900 text-black block w-full cursor-pointer"
                                                data-id="<?= $fila['id'] ?>"
                                                data-nombre="<?= htmlspecialchars($fila['name'], ENT_QUOTES) ?>"
                                                data-email="<?= htmlspecialchars($fila['email'], ENT_QUOTES) ?>"
                                                data-rol="<?= $fila['role'] ?>"
                                            >
                                            ⚙️
                                            </a>
                                        </td>
                                        
                                        <td class="py-2 px-4">
                                            <button 
                                                class="openDeleteModal font-semibold px-2 py-1 rounded transition 
                                                    bg-slate-900/60 hover:bg-slate-900 text-white block w-full cursor-pointer"
                                                    data-id="<?= htmlspecialchars($fila["id"]) ?>"
                                                    data-name="<?= htmlspecialchars($fila["name"]) ?>"
                                            >
                                                ❌
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php elseif(isset($error)): ?>
                                <tr>
                                    <td colspan="8" class="text-center text-red-600 py-4"><?= $error ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="assets/user_delete.js"></script>
    <script src="assets/user_create.js"></script>
    <script src="assets/user_edit.js"></script>
</body>
</html>