document.addEventListener("DOMContentLoaded", function () {
    // Function to fetch departments and populate the dropdown
    window.fetchDepartments = function fetchDepartments() {
        // Send AJAX request to fetch departments
        fetch('controller/departments/retrieve-deptsName.php')
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
});