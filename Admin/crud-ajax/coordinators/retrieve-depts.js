// Populate departments in the department select field
function loadDepartments(selectedDepartment) {
    $.ajax({
        url: 'controller/coordinators/retrieve-depts.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            let departmentSelect = $('#department');
            departmentSelect.empty();  // Clear the select field

            // Append the default "Choose Department" option
            departmentSelect.append('<option selected disabled>Choose Department</option>');

            // Check if departments key exists and is an array
            if (Array.isArray(response.departments)) {
                response.departments.forEach(function(department) {
                    let selected = department.department_name === selectedDepartment ? 'selected' : '';
                    departmentSelect.append(`<option value="${department.id}" ${selected}>${department.department_name}</option>`);
                });
            } else {
                console.error('Invalid response structure:', response);
            }

            // Enable the select after populating
            departmentSelect.prop('disabled', false);
        },
        error: function(xhr, status, error) {
            console.error('Error retrieving departments:', error);
        }
    });
}

// Call the function to load departments on page load
$(document).ready(function() {
    loadDepartments(); // You can pass a selectedDepartment argument if needed
});