$(document).ready(function() {
    $('#assignDeanForm').on('submit', function(e) {
        e.preventDefault(); // Prevent form submission

        // Gather form data
        var formData = {
            'last_name': $('#add_last_name').val(),
            'first_name': $('#add_first_name').val(),
            'department1': $('#add_department1').val(),
            'department2': $('#add_department2').val(),
            'department3': $('#add_department3').val(),
            'username': $('#add_username').val(),
            'password': $('#add_password').val()
        };

        $.ajax({
            url: 'controller/departments/create-dean.php', // PHP script to handle the insertion
            type: 'POST',
            data: formData,
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    alert("Dean assigned successfully!");

                    // Close the modal after success
                    $('#assignDeanModal').modal('hide'); // Replace 'yourModalId' with the actual modal ID

                    // Optionally, reset the form or reload data
                    $('#assignDeanForm')[0].reset();
                } else {
                    alert("Error: " + data.message);
                }
            },
            error: function(xhr, status, error) {
                alert("There was an error in the request: " + error);
            }
        });
    });
});
