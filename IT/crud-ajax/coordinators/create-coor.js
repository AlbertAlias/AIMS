$(document).ready(function() {
    // Handle the form submission via AJAX
    $('#coordinatorForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting the traditional way
        
        // Prepare the data from the form
        var formData = {
            last_name: $('#coor_last_name').val(),
            first_name: $('#coor_first_name').val(),
            middle_name: $('#coor_middle_name').val(),
            personal_email: $('#coor_personal_email').val(),
            department_id: $('#coor_department').val(),
            username: $('#coor_username').val(),
            password: $('#coor_password').val(),
        };

        // Perform the AJAX request
        $.ajax({
            url: 'controller/coordinators/create-coor.php', // PHP script to handle the data
            type: 'POST',
            dataType: 'json', // Expecting JSON response
            contentType: 'application/json', // Send data as JSON
            data: JSON.stringify(formData), // Convert the form data to a JSON string
            success: function(response) {
                if (response.success) {
                    // Success response handling
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: 'Coordinator added successfully!',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                    $('#coordinatorForm')[0].reset();
                    
                    loadCoor();
                    loadDepartments();
                    fetchUserAnalytics();
                } else {
                    // Error response handling
                    alert(response.message); // Show error message
                }
            },
            error: function() {
                // Handle AJAX error
                alert('An error occurred while submitting the form.');
            }
        });
    });
});