$(document).ready(function(){
    // Handle form submission
    $('#assignDeanForm').submit(function(e){
        e.preventDefault();  // Prevent default form submission

        var last_name = $('#add_last_name').val();
        var first_name = $('#add_first_name').val();
        var department1 = $('#add_department1').val();
        var department2 = $('#add_department2').val();
        var department3 = $('#add_department3').val();
        var username = $('#add_username').val();
        var password = $('#add_password').val();

        // Data to send in AJAX request
        var formData = {
            last_name: last_name,
            first_name: first_name,
            department1: department1,
            department2: department2,
            department3: department3,
            username: username,
            password: password
        };

        // AJAX request to submit form data
        $.ajax({
            url: 'controller/departments/create-dean.php', // PHP script to process the data
            type: 'POST',
            data: formData,
            dataType: 'json', // Ensure the response is parsed as JSON
            success: function(response) {
                // Handle the response
                if (response.success) {
                    alert(response.message); // Success message
                    $('#assignDeanModal').modal('hide');
                    $('#assignDeanForm')[0].reset();
                } else {
                    alert(response.message); // Error message
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred. Please try again.');
            }
        });
    });
});