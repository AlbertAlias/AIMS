$(document).ready(function() {
    // Call the PHP script to retrieve department names
    $.ajax({
        url: 'controller/coordinators/retrieve-coor-department.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                var departments = response.data;
                var departmentSelect = $('#coor_department');
                
                // Clear existing options (except the first one)
                departmentSelect.empty();
                departmentSelect.append('<option selected>Choose Department</option>');
                
                // Loop through the department data and add to the dropdown
                $.each(departments, function(index, department) {
                    departmentSelect.append('<option value="' + department.department_id + '">' + department.department_name + '</option>');
                });
                
                // Enable the select dropdown
                departmentSelect.prop('disabled', false);
            } else {
                console.error('Failed to load departments:', response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX request failed:', status, error);
        }
    });
});
