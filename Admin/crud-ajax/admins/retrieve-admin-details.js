$(document).ready(function() {
    // Attach loadAdminDetails to the window object
    window.loadAdminDetails = function(id) {
        $.ajax({
            url: 'controller/admins/retrieve-admin-details.php',
            method: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    console.error('Error:', response.error);
                    return;
                }

                // Populate the form with admin details
                $('#adminID').val(response.id);
                $('#admin_last_name').val(response.last_name).prop('disabled', false);
                $('#admin_first_name').val(response.first_name).prop('disabled', false);
                $('#admin_middle_name').val(response.middle_name).prop('disabled', false);
                $('#admin_suffix').val(response.suffix).prop('disabled', false);
                $('#admin_gender').val(response.gender).prop('disabled', false);
                $('#admin_address').val(response.address).prop('disabled', false);
                $('#admin_birthdate').val(response.birthdate).prop('disabled', false);
                $('#admin_civil_status').val(response.civil_status).prop('disabled', false);
                $('#admin_contact_number').val(response.contact_number).prop('disabled', false);
                $('#admin_personal_email').val(response.personal_email).prop('disabled', false);
                $('#admin_account_email').val(response.account_email).prop('disabled', true); // Lock the account email
                $('#admin_password').val(response.password).prop('disabled', true); // Lock the hashed password
                $('#adminUpdateBtn').prop('disabled', false);
            },
            error: function(xhr, status, error) {
                console.error('Error retrieving admin details:', error);
            }
        });
    };
});