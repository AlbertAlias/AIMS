document.addEventListener('DOMContentLoaded', function () {
    const departmentForm = document.getElementById('addDepartmentForm');  // Corrected form ID
    const deptSubmitBtn = document.getElementById('deptSubmitBtn');
    const departmentNameInput = document.getElementById('department_name');

    // Submit event for adding a department
    departmentForm.addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Get department name
        const departmentName = departmentNameInput.value.trim();

        if (departmentName === '') {
            alert('Please enter a department name.');
            return;
        }

        // AJAX request to add the department
        fetch('controller/departments/create-depts.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `department_name=${encodeURIComponent(departmentName)}`,
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);

                // Reset the form after success
                departmentForm.reset();

                // Close the modal after successful submission
                const myModal = bootstrap.Modal.getInstance(document.getElementById('addDepartmentModal'));
                myModal.hide();  // Close the modal
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while adding the department.');
        });
    });
});