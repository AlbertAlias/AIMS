$(document).ready(function() {
    // Function to load and display admins in buttons
    window.loadAdmins = function() {
        $.ajax({
            url: 'controller/admins/retrieve-admins.php', // Adjust this path as needed
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                let adminsInfo = $('#adminsInfo');
                adminsInfo.empty();  // Clear the div before populating

                response.forEach(function(admin) {
                    // Create a button for each admin
                    let btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 intern-btn" data-id="${admin.id}">
                                    ${admin.last_name}, ${admin.first_name}
                                </button>`;
                    adminsInfo.append(btn);
                });

                // Attach event listeners to the dynamically created buttons
                $('.intern-btn').on('click', function() {
                    const adminId = $(this).data('id'); // Get the data-id of the clicked button
                    window.loadAdminDetails(adminId);   // Call the function to load admin details
                });
            },
            error: function(xhr, status, error) {
                console.error('Failed to load admins:', error);
            }
        });
    };

    // Function to load admin details based on the id
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
    
                // Log response for debugging
                console.log(response);
    
                // Populate the form with the retrieved admin data
                $('#adminID').val(response.id);
                $('#admin_first_name').val(response.first_name).prop('disabled', false);
                $('#admin_last_name').val(response.last_name).prop('disabled', false);
                $('#admin_middle_name').val(response.middle_name).prop('disabled', false);
                $('#admin_suffix').val(response.suffix).prop('disabled', false);
                $('#admin_address').val(response.address).prop('disabled', false);
                $('#admin_birthdate').val(response.birthdate).prop('disabled', false);
                $('#admin_personal_email').val(response.personal_email).prop('disabled', false);
                $('#admin_contact_number').val(response.contact_number).prop('disabled', false);
                $('#admin_gender').val(response.gender).prop('disabled', false);
                $('#admin_civil_status').val(response.civil_status).prop('disabled', false);
                $('#admin_account_email').val(response.account_email).prop('disabled', false);
                $('#admin_password').val(response.password).prop('disabled', false);
    
                console.log('Setting role to:', response.role);
                $('#role').val(response.role).prop('disabled', false);

                // Call to show the update button and cancel button
                showUpdateButton(); // Call this to show the appropriate buttons
            },
            error: function(xhr, status, error) {
                console.error('Error retrieving admin details:', error);
            }
        });
    };

    loadAdmins(); // Call the function to load admins on page load
});