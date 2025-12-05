<?php

$name = $name ?? '';
$email = $email ?? '';
$role = $role ?? '';
$error = $error ?? '';
$success = $success ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['form_type'] ?? '') === 'create') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $role = trim($_POST['role']);

    try {
        
        $pdo = getDbConnection();
        $userController = new UserController($pdo);

        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setRole($role);

        $userController->addUser($user);

        $success = "Usuario creado correctamente.";
        $name = $email = $role = '';
        header("Location: index.php");
    } catch (Exception $e) {
        $error = "Error al crear el usuario: " . $e->getMessage();
    }
}
?>

<div>
    <h3 class="text-xl font-semibold mb-4 text-center text-[#E0E0E0]">Crear Usuario</h3>

    <?php if($success): ?>
        <div class="text-green-400 mb-2"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <?php if($error): ?>
        <div class="text-red-400 mb-2"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    
    <form method="post" id="createUserForm" class="flex flex-col gap-4">
        <input type="hidden" name="form_type" value="create"> 

        <div class="flex flex-col">
            <label for="name" class="text-stone-200 mb-1">Nombre y apellidos:</label>
            <input type="text" id="name" name="name" required
                    value="<?= htmlspecialchars($name) ?>"
                    class="p-2 rounded bg-[#24242E] text-[#E0E0E0] border border-[#333344] focus:outline-none focus:ring-2 focus:ring-blue-500"/>
        </div>

        <div class="flex flex-col">
            <label for="email" class="text-stone-200 mb-1">Email:</label>
            <input type="email" id="email" name="email" required
                    value="<?= htmlspecialchars($email) ?>"
                    class="p-2 rounded bg-[#24242E] text-[#E0E0E0] border border-[#333344] focus:outline-none focus:ring-2 focus:ring-blue-500"/>
        </div>

        <div class="flex flex-col">
            <label for="role" class="text-stone-200 mb-1">Rol:</label>
            <select id="role" name="role" required
                    class="p-2 rounded bg-[#24242E] text-[#E0E0E0] border border-[#333344] focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Seleccionar rol --</option>
                <option value="Administrador" class="text-amber-500" <?= ($role=='administrador') ? 'selected' : '' ?>>Administrador</option>
                <option value="Editor" class="text-blue-500" <?= ($role=='editor') ? 'selected' : '' ?>>Editor</option>
                <option class="text-emerald-500" value="Visitante" <?= ($role=='visitante') ? 'selected' : '' ?>>Visitante</option>
            </select>
        </div>

        <div class="flex justify-end space-x-4 mt-4">
            <button type="button" id="cancelCreateBtn" 
                    class="px-4 py-2 bg-[#333344] text-[#E0E0E0] rounded hover:bg-[#4A4A5A] transition">
                Cancelar
            </button>
            <button type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Crear Usuario
            </button>
        </div>
    </form>
</div>
