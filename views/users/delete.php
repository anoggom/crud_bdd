<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {

    $pdo = getDbConnection();
    $userController = new UserController($pdo);

    $id = (int) $_POST['id'];

    $userController->deleteUser($id);

    header("Location: index.php");
    exit;
}
?>

<div class="bg-[#24242E] rounded-lg p-6 shadow-lg relative w-full max-w-md">

    <button id="closeDeleteModalBtn" 
        class="absolute top-2 right-2 text-white text-xl font-bold hover:text-red-400">
        &times;
    </button>

    <h3 class="text-xl text-[#E0E0E0] mb-4">Confirmar eliminación</h3>

    <p class="text-[#E0E0E0] mb-6">
        ¿Estás seguro que deseas eliminar al usuario 
        <span id="userName" class="font-semibold text-red-400"></span>?
    </p>

    <form method="POST" class="flex justify-end space-x-4">
        <input type="hidden" name="id" id="userIdToDelete">

        <button type="button" id="cancelDeleteBtn"
            class="px-4 py-2 bg-[#333344] text-[#E0E0E0] rounded hover:bg-[#4A4A5A] transition">
            Cancelar
        </button>

        <button type="submit"
            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
            Eliminar
        </button>
    </form>

</div>
