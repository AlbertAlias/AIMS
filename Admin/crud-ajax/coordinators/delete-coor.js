document.addEventListener('DOMContentLoaded', function() {
    const deleteBtn = document.getElementById('coorDeleteBtn');
    const coordinatorForm = document.getElementById('coordinatorForm');

    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            const coorId = coordinatorForm.querySelector('#coorID').value;

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this coordinator!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('controller/coordinators/delete-coor.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ id: coorId })
                    })
                    .then(response => response.text())
                    .then(text => {
                        console.log('Raw response:', text);
                        const data = JSON.parse(text);
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Coordinator deleted successfully.',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                background: '#b9f6ca',
                                iconColor: '#2e7d32',
                                color: '#155724',
                                customClass: {
                                    popup: 'mt-5'
                                }
                            });

                            if (typeof window.loadCoordinators === 'function') {
                                window.loadCoordinators();
                            }

                            if (typeof window.disableAndResetForms === 'function') {
                                window.disableAndResetForms();
                            }

                            document.getElementById('coorDeleteBtn').style.display = 'none';
                            document.getElementById('coorUpdateBtn').style.display = 'none';

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error deleting coordinator: ' + data.message,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                background: '#f8bbd0',
                                iconColor: '#c62828',
                                color: '#721c24',
                                customClass: {
                                    popup: 'mt-5'
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        });
    } else {
        console.error('Delete button not found.');
    }
});