document.addEventListener('DOMContentLoaded', function() {
    const departmentForm = document.getElementById('departmentForm');
    const updateBtn = document.getElementById('deptUpdateBtn');
    const departmentNameInput = document.getElementById('departmentName');
    const departmentHeadInput = document.getElementById('departmentHead');

    if (!departmentForm || !(departmentForm instanceof HTMLFormElement)) {
        console.error('Department form not found or is not an HTMLFormElement.');
        return;
    }

    // Function to trigger the Update button click
    function triggerUpdateButtonClick() {
        if (updateBtn && updateBtn.style.display !== 'none') {
            updateBtn.click();
        }
    }

    // Event listener to handle Enter key press
    [departmentNameInput, departmentHeadInput].forEach(inputField => {
        inputField.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent form submission on Enter
                triggerUpdateButtonClick(); // Trigger update button click
            }
        });
    });

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

                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: 'Department updated successfully',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });

                    if (typeof refreshDepartmentList === 'function') {
                        refreshDepartmentList();
                    }

                    if (typeof window.resetAndLockForm === 'function') {
                        window.resetAndLockForm();
                    }
                } else {
                    console.error('Error updating department: ' + data.message);

                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'error',
                        title: 'Error: ' + data.message,
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

                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'error',
                    title: 'An unexpected error occurred',
                    showConfirmButton: false,
                    timer: 3000,
                    background: '#f8bbd0',
                    iconColor: '#c62828',
                    color: '#721c24',
                    customClass: {
                        popup: 'mt-5'
                    }
                });
            });
        });
    } else {
        console.error('Update button not found.');
    }
});