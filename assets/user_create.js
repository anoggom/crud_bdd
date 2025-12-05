document.addEventListener("DOMContentLoaded", function () {
    const openModalBtn = document.getElementById("openModalBtn");
    const userModal = document.getElementById("userModal");
    const closeModalBtn = document.getElementById("closeModalBtn");

    openModalBtn.addEventListener("click", () => {
        userModal.classList.remove("hidden");
    });

    closeModalBtn.addEventListener("click", () => {
        userModal.classList.add("hidden");
    });

    // Cerrar modal si haces click fuera del contenido
    userModal.addEventListener("click", (e) => {
        if (e.target === userModal) {
            userModal.classList.add("hidden");
        }
    });
});
