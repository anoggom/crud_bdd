document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', e => {
        e.preventDefault();

        const id = btn.dataset.id;
        const nombre = btn.dataset.nombre;
        const email = btn.dataset.email;
        const rol = btn.dataset.rol;

        const editUserId = document.getElementById('editUserId');
        const editUserName = document.getElementById('editUserName');
        const editUserEmail = document.getElementById('editUserEmail');
        const editUserRole = document.getElementById('editUserRole');
        const modalEditUser = document.getElementById('modalEditUser');

        if (editUserId && editUserName && editUserEmail && editUserRole && modalEditUser) {
            editUserId.value = id;
            editUserName.value = nombre;
            editUserEmail.value = email;
            editUserRole.value = rol;

            modalEditUser.style.display = 'flex';
        } else {
            console.error("Error: No se pudieron encontrar todos los campos del formulario o el modal.");
        }
    });
});

// Cerrar modal al pulsar botón "X"
document.getElementById('closeModalEditUser').onclick = () => {
    document.getElementById('modalEditUser').style.display = 'none';
};

// Cerrar modal al hacer click fuera del contenido
document.getElementById('modalEditUser').onclick = e => {
    if (e.target === e.currentTarget) {
        e.currentTarget.style.display = 'none';
    }
};
