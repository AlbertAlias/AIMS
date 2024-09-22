$(document).ready(function() {
    // Event listener for the Update button
    $('#updateBtn').on('click', function() {
        console.log('Update button clicked'); // Check if this runs

        // Prevent the default form submission if needed
        const internID = $('#internID').val(); // Ensure you're using the correct ID
        const data = {
            id: internID,
            last_name: $('#last_name').val(),
            first_name: $('#first_name').val(),
            middle_name: $('#middle_name').val(),
            suffix: $('#suffix').val(),
            gender: $('#gender').val(),
            address: $('#address').val(),
            birthdate: $('#birthdate').val(),
            civil_status: $('#civil_status').val(),
            personal_email: $('#personal_email').val(),
            contact_number: $('#contact_number').val(),
            studentID: $('#studentID').val(),
            department: $('#department').val(),
            coordinator_name: $('#coordinator_name').val(),
            hours_needed: $('#hours_needed').val(),
            coordinator_email: $('#coordinator_email').val(),
            internship_status: $('#internship_status').val(),
            account_email: $('#account_email').val(),
            password: $('#password').val()
        };

        // Perform AJAX call
        $.ajax({
            url: 'controller/interns/update-interns.php',
            method: 'POST',
            data: data,
            success: function(response) {
                console.log(response);
                if (response.success) {
                    alert('Intern updated successfully!');
                    // Call disableAndResetForms to reset and lock the forms
                    disableAndResetForms();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('An error occurred while updating intern data. Please try again.');
            }
        });
    });

    // Event listener for the form submission (if needed)
    $('#internsForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        // If you want to handle submit separately, do that here
    });
});