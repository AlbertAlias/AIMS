$(document).ready(function() {
    // Handle form submission
    $('#deanForm').on('submit', function(event) {
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
            url: 'controller/departments/create-dept-dean.php',
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
                    // Optionally clear the form
                    $('#deanForm')[0].reset();

                    // Enable the submit button if it was disabled
                    $('#deanSubmitBtn').prop('disabled', false);

                    // Refresh the department list
                    fetchDepartments();
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