function fetchDepartments() {
    const departmentSelect = document.getElementById('dean_department');
    
    // Show a loading message or spinner
    departmentSelect.innerHTML = '<option selected>Loading...</option>';
    
    // Send AJAX request to fetch departments with no dean assigned
    fetch('controller/departments/retrieve-deptsName.php')
        .then(response => response.json())
        .then(data => {
            // Clear existing options
            departmentSelect.innerHTML = '<option selected>Choose Department</option>';

            if (data.length === 0) {
                departmentSelect.disabled = true;
                return; // No departments to display, exit the function
            }

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
            // Handle error, maybe display a message to the user
            departmentSelect.innerHTML = '<option selected>Error loading departments</option>';
            departmentSelect.disabled = true;
        });
}

// Call the function to populate departments on page load
document.addEventListener("DOMContentLoaded", function () {
    fetchDepartments();  // Now this works because fetchDepartments is defined globally
});