document.addEventListener('DOMContentLoaded', function() {
    const departmentForm = document.getElementById('departmentForm');
    const updateBtn = document.getElementById('updateBtn');

    if (!departmentForm || !(departmentForm instanceof HTMLFormElement)) {
        console.error('Department form not found or is not an HTMLFormElement.');
        return;
    }

    if (updateBtn) {
        updateBtn.addEventListener('click', function(event) {
            event.preventDefault();
            console.log('Update button clicked');

            const formData = new FormData(departmentForm);

            for (const [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);  // Log each form data entry
            }

            fetch('controller/departments/update-depts.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Department updated successfully');

                    // SweetAlert2 toast for success with light green container
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: 'Department updated successfully',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca', // Light green container background
                        iconColor: '#2e7d32', // Darker green icon
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });

                    // Call the function to refresh the department list
                    if (typeof refreshDepartmentList === 'function') {
                        refreshDepartmentList();
                    } else {
                        console.error('refreshDepartmentList function is not available');
                    }

                    if (typeof window.resetAndLockForm === 'function') {
                        console.log('Calling resetAndLockForm');
                        window.resetAndLockForm();
                    } else {
                        console.error('resetAndLockForm function is not available');
                    }
                } else {
                    console.error('Error updating department: ' + data.message);

                    // SweetAlert2 toast for error with darker red containerz
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'error',
                        title: 'Error: ' + data.message,
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#f8bbd0', // Darker red container background
                        iconColor: '#c62828', // Darker red icon
                        color: '#721c24',
                        customClass: {
                            popup: 'mt-5' // Bootstrap margin-top of 4
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);

                // SweetAlert2 toast for unexpected errors with darker red container
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'error',
                    title: 'An unexpected error occurred',
                    showConfirmButton: false,
                    timer: 3000,
                    background: '#f8bbd0', // Darker red container background
                    iconColor: '#c62828', // Darker red icon
                    color: '#721c24',
                    customClass: {
                        popup: 'mt-5' // Bootstrap margin-top of 4
                    }
                });
            });
        });
    } else {
        console.error('Update button not found.');
    }
});