function fetchDepartments() {
    const departmentSelect = document.getElementById('dean_department');

    // Provide initial loading message
    departmentSelect.innerHTML = '<option selected>Loading...</option>';

    // Fetch department data
    fetch('controller/departments/retrieve-deptsName.php')
        .then(response => response.json())
        .then(data => {
            // Clear existing options and reset to default message
            departmentSelect.innerHTML = '<option selected>Choose Department</option>';

            if (data.length === 0) {
                // No departments available
                const noOptions = document.createElement('option');
                noOptions.textContent = 'No departments available';
                noOptions.value = '';
                departmentSelect.appendChild(noOptions);
                return;
            }

            // Populate dropdown with departments
            data.forEach(department => {
                const option = document.createElement('option');
                option.value = department.id;
                option.textContent = department.department_name;
                departmentSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching departments:', error);

            // Add an error option
            departmentSelect.innerHTML = '<option selected>Error loading departments</option>';
        });
}

// Call function to populate departments on DOMContentLoaded
document.addEventListener('DOMContentLoaded', fetchDepartments);