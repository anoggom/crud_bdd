<?php
if (!isset($errors)) $errors = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'edit') {
    // Validaciones básicas
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];

    if ($name === '') $errors[] = "El nombre no puede estar vacío.";
    if ($email === '') $errors[] = "El email no puede estar vacío.";
    $valid_roles = ['Administrador', 'Editor', 'Visitante'];
    if (!in_array($role, $valid_roles)) $errors[] = "Rol no válido.";

    if (empty($errors)) {
        try {
            $userObj = new User();
            $userObj->setId($id);
            $userObj->setName($name);
            $userObj->setEmail($email);
            $userObj->setRole($role);
            $userController->editUser($userObj);

            header("Location: index.php");
            exit;
        } catch (Exception $e) {
            error_log($e);
            $errors[] = $e->getMessage();
        }
    }
}
?>


<div class="text-[#E0E0E0]">
    <h3 class="text-xl font-semibold mb-4 text-center">Editar Usuario</h3>

    <?php if (!empty($errors)): ?>
        <div class="text-red-400 mb-2">
            <?php foreach ($errors as $error) echo "<p>$error</p>"; ?>
        </div>
    <?php endif; ?>

    <form id="editUserForm" action="" method="post" class="flex flex-col gap-4">
        <input type="hidden" name="form_type" value="edit"> 
        
        <div class="flex flex-col">
            <label class="text-stone-200 mb-1">ID de Usuario:</label>
            <input type="text" id="editUserId" name="id" readonly 
                   class="p-2 rounded bg-[#24242E] text-[#E0E0E0] border border-[#333344] opacity-50 cursor-not-allowed"/>
        </div>

        <div class="flex flex-col">
            <label for="editUserName" class="text-stone-200 mb-1">Nombre:</label>
            <input type="text" id="editUserName" name="name" required
                   class="p-2 rounded bg-[#24242E] text-[#E0E0E0] border border-[#333344] focus:outline-none focus:ring-2 focus:ring-blue-500"/>
            <span id="error-edit-name" class="text-red-400 text-sm mt-1 hidden"></span>
        </div>

        <div class="flex flex-col">
            <label for="editUserEmail" class="text-stone-200 mb-1">Email:</label>
            <input type="email" id="editUserEmail" name="email" 
                   class="p-2 rounded bg-[#24242E] text-[#E0E0E0] border border-[#333344] focus:outline-none focus:ring-2 focus:ring-blue-500"/>
            <span id="error-edit-email" class="text-red-400 text-sm mt-1 hidden"></span>
        </div>

        <div class="flex flex-col">
            <label for="editUserRole" class="text-stone-200 mb-1">Rol:</label>
            <select id="editUserRole" name="role" required
                class="p-2 rounded bg-[#24242E] border border-[#333344] focus:outline-none focus:ring-2 focus:ring-blue-500 <?= $roleColor ?>">
                <option value="Administrador" class="text-amber-500" <?= ($role=='administrador') ? 'selected' : '' ?>>Administrador</option>
                <option value="Editor" class="text-blue-500" <?= ($role=='editor') ? 'selected' : '' ?>>Editor</option>
                <option class="text-emerald-500" value="Visitante" <?= ($role=='visitante') ? 'selected' : '' ?>>Visitante</option>
            </select>
            <span id="error-edit-role" class="text-red-400 text-sm mt-1 hidden"></span>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded active:bg-blue-700 transition-colors font-semibold my-2">
            Guardar Cambios
        </button>
    </form>
</div>