$(document).ready(function() {
    // On opening the Edit Department modal, fetch departments
    $('#editDeptModal').on('show.bs.modal', function () {
        $.ajax({
            url: 'controller/departments/retrieve-depts.php',  // The PHP file that retrieves departments
            type: 'GET',
            dataType: 'json',  // Expecting JSON data
            success: function(response) {
                if (response.status == 'success') {
                    const departmentSelect = $('#department_select');
                    departmentSelect.empty(); // Clear existing options
                    departmentSelect.append('<option value="" disabled selected>Select a department</option>');
                    
                    // Append each department as an option in the dropdown
                    response.departments.forEach(function(department) {
                        departmentSelect.append('<option value="' + department.id + '">' + department.department_name + '</option>');
                    });
                } else {
                    alert('Failed to load departments.');
                }
            },
            error: function() {
                alert('An error occurred while fetching departments.');
            }
        });
    });

    // When a department is selected, enable editing and store department ID
    $('#department_select').on('change', function() {
        const selectedDeptId = $(this).val();
        const selectedDeptName = $("#department_select option:selected").text();

        // Populate the input with the department name
        $('#edit_department_name').val(selectedDeptName);

        // Enable the update button
        $('#editDeptUpdateBtn').prop('disabled', false);

        // Store the department ID in the button as data
        $('#editDeptUpdateBtn').data('dept-id', selectedDeptId);
    });
});
