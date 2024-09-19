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
                    alert('Department updated successfully.');

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
                    alert('Error updating department: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    } else {
        console.error('Update button not found.');
    }
});