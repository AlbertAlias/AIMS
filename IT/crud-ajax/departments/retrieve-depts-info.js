$(document).ready(function() {
    // Event listener for button click
    $(document).on('click', '.coor-btn', function() {
        var departmentName = $(this).data('id'); // Get department name from the button's data-id
        
        // Send AJAX request to fetch department details
        $.ajax({
            url: 'controller/departments/retrieve-depts-info.php', // PHP file that retrieves department data
            type: 'GET',
            data: { department_name: departmentName },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    // Populate the input field with the department name
                    $('#department_name').val(data.department_name);
                    $('#deptID').val(data.department_id);  // Optionally set department_id in hidden input
                    
                    // Hide submit button and show update button
                    $('#deptSubmitBtn').hide();
                    $('#deptUpdateBtn').show();
                } else {
                    alert('Department not found');
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred while fetching data: ' + error);
            }
        });
    });
});
