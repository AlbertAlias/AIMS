$(document).ready(function () {
    // Remove any existing click event handlers for the update button
    $('#adminUpdateBtn').off('click').on('click', function () {
        console.log('Update button clicked');

        const adminID = $('#adminID').val(); // Ensure you're using the correct ID

        // Collect the form data
        const data = {
            id: adminID,
            admin_last_name: $('#admin_last_name').val(),
            admin_first_name: $('#admin_first_name').val(),
            admin_middle_name: $('#admin_middle_name').val(),
            admin_suffix: $('#admin_suffix').val(),
            admin_gender: $('#admin_gender').val(),
            admin_address: $('#admin_address').val(),
            admin_birthdate: $('#admin_birthdate').val(),
            admin_civil_status: $('#admin_civil_status').val(),
            admin_personal_email: $('#admin_personal_email').val(),
            admin_contact_number: $('#admin_contact_number').val(),
            admin_account_email: $('#admin_account_email').val(),
            admin_password: $('#admin_password').val(),
            role: $('#role').val()
        };

        // Disable the update button to prevent multiple clicks
        $(this).prop('disabled', true);

        // Perform AJAX call
        $.ajax({
            url: 'controller/admins/update-admins.php',
            method: 'POST',
            data: data,
            dataType: 'json', // Expect JSON response from the server
            success: function (response) {
                if (response.success) {
                    alert('Admin updated successfully!');
                    disableAndResetForms(); // Ensure this function exists to handle resetting forms
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
                console.error('Response Text:', xhr.responseText); // Log the raw response
                alert('An error occurred while updating admin data. Please try again.');
            },
            complete: function () {
                // Re-enable the update button
                $('#adminUpdateBtn').prop('disabled', false);
            }
        });
    });
});
