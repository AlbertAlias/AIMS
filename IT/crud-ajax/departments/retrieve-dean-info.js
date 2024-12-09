$(document).ready(function () {
    // When a button is clicked (each dean button)
    $('.coor-btn').click(function () {
        var deanName = $(this).data('id');  // Get the dean's full name from the button
        
        if (deanName) {
            var deanNameParts = deanName.split(' ');  // Split into first and last name
            
            // AJAX request to fetch dean data
            $.ajax({
                url: 'controller/departments/retrieve-dean-info.php',  // PHP file to handle the data fetching
                type: 'GET',
                data: { first_name: deanNameParts[0], last_name: deanNameParts[1] },
                success: function(response) {
                    var data = JSON.parse(response);
                    
                    if (data.error) {
                        console.log(data.error);
                        return;
                    }

                    // Populate the form fields with the fetched data
                    $('#add_first_name').val(data.first_name);
                    $('#add_last_name').val(data.last_name);
                    $('#add_username').val(data.username);
                    
                    // Handle department dropdowns
                    var departments = data.departments;
                    // Clear existing options
                    $('#add_department1, #add_department2, #add_department3').empty().append('<option selected>Choose Department</option>');
                    
                    // Populate the first department dropdown
                    if (departments.length > 0) {
                        $('#add_department1').val(departments[0]);
                    }

                    // Populate the second department dropdown if it exists
                    if (departments.length > 1) {
                        $('#add_department2').prop('disabled', false).val(departments[1]);
                    } else {
                        $('#add_department2').prop('disabled', true);
                    }

                    // Populate the third department dropdown if it exists
                    if (departments.length > 2) {
                        $('#add_department3').prop('disabled', false).val(departments[2]);
                    } else {
                        $('#add_department3').prop('disabled', true);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + error);
                }
            });
        } else {
            console.log("No dean name provided.");
        }
    });
});