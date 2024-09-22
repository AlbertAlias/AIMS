function loadDepartments(selectedDepartment, isEnabled = false) {
    $.ajax({
        url: 'controller/interns/retrieve-deptsName.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            let departmentSelect = $('#department');
            departmentSelect.empty();  // Clear the select field

            // Append the default "Choose Department" option
            departmentSelect.append('<option selected disabled>Choose Department</option>');

            // Populate the department options
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
        },
        error: function(xhr, status, error) {
            console.error('Error retrieving departments:', error);
        }
    });
}

// Function to load coordinator details based on the selected department
function loadCoorInfo(departmentName) {
    $.ajax({
        url: 'controller/interns/retrieve-coor-info.php',
        method: 'GET',
        data: { department: departmentName },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                let coordinatorName = response.coordinator.last_name + ', ' + response.coordinator.first_name;
                $('#coordinator_name').val(coordinatorName);
                $('#coordinator_email').val(response.coordinator.personal_email);
            } else {
                console.error('Coordinator not found for this department');
                $('#coordinator_name').val('');
                $('#coordinator_email').val('');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error retrieving coordinator info:', error);
            console.error('Response text:', xhr.responseText);  // Show the raw response for debugging
        }
    });
}


// Event listener for department select change
$('#department').on('change', function() {
    let selectedDepartment = $(this).val();
    if (selectedDepartment) {
        loadCoorInfo(selectedDepartment);  // Fetch and load coordinator details
    }
});

// Call the function to load departments on page load, but keep it disabled
$(document).ready(function() {
    loadDepartments();  // Load the departments initially
});