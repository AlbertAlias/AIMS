document.addEventListener('DOMContentLoaded', function() {
    const deleteBtn = document.getElementById('coorDeleteBtn');
    const coordinatorForm = document.getElementById('coordinatorForm');

    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            const userId = coordinatorForm.querySelector('#coorID').value; // Assuming this is the user_id

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
                        body: JSON.stringify({ id: userId }) // Pass the user_id for deletion
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

                            // Remove the deleted coordinator button from the UI
                            const deletedCoorButton = document.querySelector(`.coor-btn[data-id='${userId}']`);
                            if (deletedCoorButton) {
                                deletedCoorButton.remove();
                            }

                            // Reset and lock the forms after successful deletion
                            if (typeof window.resetAndLockForms === 'function') {
                                window.resetAndLockForms();
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