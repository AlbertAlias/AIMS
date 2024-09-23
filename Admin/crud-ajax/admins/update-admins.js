$(document).ready(function() {
    // Event listener for the Update button
    $('#internUpdateBtn').on('click', function() {
        console.log('Update button clicked'); // Check if this runs

        // Prevent the default form submission if needed
        const adminID = $('#adminID').val(); // Ensure you're using the correct ID
        const data = {
            id: adminID,
            last_name: $('#admin_last_name').val(),
            first_name: $('#admin_first_name').val(),
            middle_name: $('#admin-middle_name').val(),
            suffix: $('#admin_suffix').val(),
            gender: $('#admin_gender').val(),
            address: $('#admin_address').val(),
            birthdate: $('#admin_birthdate').val(),
            civil_status: $('#admin_civil_status').val(),
            contact_number: $('#admin_contact_number').val(),
            personal_email: $('#admin_personal_email').val(),
            account_email: $('#admin_account_email').val(),
            password: $('#admin_password').val(),
            role: $('#role').val()
        };

        // Perform AJAX call
        $.ajax({
            url: 'controller/admins/update-admins.php',
            method: 'POST',
            data: data,
            success: function(response) {
                console.log(response);
                if (response.success) {
                    alert('Intern updated successfully!');
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