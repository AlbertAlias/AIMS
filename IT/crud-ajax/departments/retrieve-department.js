$(document).ready(function() {
    // Open modal trigger
    $('#assignDeanModal').on('shown.bs.modal', function () {
        // Make AJAX request when the modal is shown
        $.ajax({
            url: 'controller/departments/retrieve-department.php', // PHP file to fetch department data
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Clear current options for all department selects
                    $('#add_department1').html('<option selected>Choose Department 1</option>');
                    $('#add_department2').html('<option selected>Choose Department 2</option>');
                    $('#add_department3').html('<option selected>Choose Department 3</option>');

                    // Add options dynamically from the response for each department select
                    response.departments.forEach(function(department) {
                        $('#add_department1').append('<option value="' + department.department_id + '">' + department.department_name + '</option>');
                        $('#add_department2').append('<option value="' + department.department_id + '">' + department.department_name + '</option>');
                        $('#add_department3').append('<option value="' + department.department_id + '">' + department.department_name + '</option>');
                    });
                } else {
                    alert('Error fetching departments');
                }
            },
            error: function() {
                alert('Failed to retrieve data');
            }
        });
    });
});
