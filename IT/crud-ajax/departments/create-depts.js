document.addEventListener('DOMContentLoaded', function () {
    const departmentForm = document.getElementById('departmentForm');
    const deptSubmitBtn = document.getElementById('deptSubmitBtn');
    const departmentNameInput = document.getElementById('department_name');
    const cancelBtn = document.getElementById('deptCancelBtn'); // Added cancel button reference
    const coorDepartmentSelect = document.getElementById('dean_department'); // Reference to select

    // Function to fetch departments and populate the dropdown
    function fetchDepartments() {
        fetch('controller/departments/retrieve-depts.php')
            .then(response => response.json())
            .then(data => {
                const departmentSelect = document.getElementById('dean_department');
                
                // Clear existing options
                departmentSelect.innerHTML = '<option selected>Choose Department</option>';

                // Populate the select dropdown with department options
                data.forEach(department => {
                    const option = document.createElement('option');
                    option.value = department.id;
                    option.textContent = department.department_name;
                    departmentSelect.appendChild(option);
                });

                // Enable the select dropdown after populating it
                departmentSelect.disabled = false;
            })
            .catch(error => {
                console.error('Error fetching departments:', error);
            });
    }

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

                // Reset and lock department form
                departmentForm.reset();
                // Call fetchDepartments to update the select options
                fetchDepartments();
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