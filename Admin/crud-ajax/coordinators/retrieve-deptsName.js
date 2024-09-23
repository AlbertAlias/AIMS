// Populate departments in the department select field
function loadDepartments(selectedDepartment, isEnabled = false) {  // Added isEnabled argument
    $.ajax({
        url: 'controller/coordinators/retrieve-deptsName.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            let departmentSelect = $('#coor_department');
            departmentSelect.empty();  // Clear the select field

            // Append the default "Choose Department" option
            departmentSelect.append('<option selected disabled>Choose Department</option>');

            // Check if departments key exists and is an array
            if (Array.isArray(response.departments)) {
                response.departments.forEach(function(department) {
                    let selected = department.department_name == selectedDepartment ? 'selected' : '';
                    departmentSelect.append(`<option value="${department.department_name}" ${selected}>${department.department_name}</option>`);
                });
            } else {
                console.error('Invalid response structure:', response);
            }

            // Enable or disable the select based on isEnabled parameter
            departmentSelect.prop('disabled', !isEnabled);  // Disable by default unless explicitly enabled
            console.log('Department select enabled:', isEnabled);
        },
        error: function(xhr, status, error) {
            console.error('Error retrieving departments:', error);
        }
    });
}

// Event listener for the "Add Coordinator" button to enable department select
$('#addCoordinatorsBtn').on('click', function() {
    // When adding a coordinator, load departments and enable the select
    loadDepartments(null, true);  // Enable the department select
});

// Call the function to load departments on page load, but keep it disabled
$(document).ready(function() {
    loadDepartments();  // Keep the department select disabled by default
});
