$(document).ready(function() {
    // Handle form submission
    $('#assignDeanForm').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get form data
        const lastName = $('#last_name').val();
        const firstName = $('#first_name').val();
        const department = $('#dean_department').val();
        const username = $('#username').val();
        const password = $('#password').val();

        // Validate the required fields
        if (!lastName || !firstName || department === "Choose Department" || !username || !password) {
            alert("Please fill in all required fields.");
            return; // Prevent form submission if any required field is empty
        }

        // If validation passes, send AJAX request to PHP to insert data into the database
        $.ajax({
            url: 'controller/departments/create-dean.php',
            type: 'POST',
            data: {
                last_name: lastName,
                first_name: firstName,
                dean_department: department,
                username: username,
                password: password
            },
            success: function(response) {
                const data = JSON.parse(response);
                if (data.success) {
                    alert('Department Dean created successfully');
                    // Close the modal
                    $('#assignDeanModal').modal('hide');
                    // Optionally, you can clear the form fields if needed
                    $('#assignDeanForm')[0].reset();
                } else {
                    alert('Error: ' + data.error);
                }
            },
            error: function(xhr, status, error) {
                alert('Request failed: ' + status + ' - ' + error);
            }
        });
    });
});