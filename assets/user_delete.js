document.addEventListener("DOMContentLoaded", () => {
    const deleteModal = document.getElementById("deleteModal");
    const deleteButtons = document.querySelectorAll(".openDeleteModal");
    const closeDeleteModalBtn = document.getElementById("closeDeleteModalBtn");
    const cancelDeleteBtn = document.getElementById("cancelDeleteBtn");

    const userNameSpan = document.getElementById("userName");
    const userIdInput = document.getElementById("userIdToDelete");

    // Abrir el modal e insertar datos
    deleteButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.getAttribute("data-id");
            const name = btn.getAttribute("data-name");

            userNameSpan.textContent = name;
            userIdInput.value = id;

            deleteModal.style.display = "flex";
        });
    });

    // Cerrar modal
    closeDeleteModalBtn.addEventListener("click", () => {
        deleteModal.style.display = "none";
    });

    cancelDeleteBtn.addEventListener("click", () => {
        deleteModal.style.display = "none";
    });
});
