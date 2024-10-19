document.addEventListener('DOMContentLoaded', function() {
    const deleteBtn = document.getElementById('deptDeleteBtn');
    const departmentForm = document.getElementById('departmentForm');

    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            const deptId = departmentForm.querySelector('#departmentId').value; // Get ID from hidden input

            // Confirm deletion with SweetAlert
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this department!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proceed with deletion if confirmed
                    fetch('controller/departments/delete-depts.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ id: deptId })
                    })
                    .then(response => response.text()) // Change to text first
                    .then(text => {
                        console.log('Raw response:', text); // Log raw response for debugging
                        const data = JSON.parse(text); // Then parse it as JSON
                        if (data.success) {
                            // Show success toast
                            Swal.fire({
                                icon: 'success',
                                title: 'Department deleted successfully.',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                background: '#b9f6ca', // Light green background
                                iconColor: '#2e7d32', // Darker green icon
                                color: '#155724', // Text color
                                customClass: {
                                    popup: 'mt-5' // Custom class for additional styling
                                }
                            });

                            // Refresh the department list
                            if (typeof window.refreshDepartmentList === 'function') {
                                window.refreshDepartmentList();
                            }

                            // Reset and lock the form
                            if (typeof window.resetAndLockForm === 'function') {
                                window.resetAndLockForm(); // Call to lock the form
                            }
                        } else {
                            // Show error toast
                            Swal.fire({
                                icon: 'error',
                                title: 'Error deleting department: ' + data.message,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                background: '#f8bbd0', // Dark red background
                                iconColor: '#c62828', // Darker red icon
                                color: '#721c24', // Text color
                                customClass: {
                                    popup: 'mt-5' // Custom class for additional styling
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