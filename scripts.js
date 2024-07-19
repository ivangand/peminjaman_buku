document.addEventListener('DOMContentLoaded', (event) => {
    const modal = document.getElementById('deleteModal');
    const closeBtn = document.querySelector('.close');
    const confirmDeleteBtn = document.getElementById('confirmDelete');
    const cancelDeleteBtn = document.getElementById('cancelDelete');
    let deleteId = null;

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            deleteId = this.getAttribute('data-id');
            modal.style.display = 'block';
        });
    });

    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    cancelDeleteBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    confirmDeleteBtn.addEventListener('click', () => {
        if (deleteId !== null) {
            window.location.href = `delete_book.php?id=${deleteId}`;
        }
    });

    window.addEventListener('click', (event) => {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
});

function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    if (sidebar.style.display === 'none' || sidebar.style.display === '') {
        sidebar.style.display = 'block';
    } else {
        sidebar.style.display = 'none';
    }
}
