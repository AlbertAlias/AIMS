$(document).ready(function() {
    window.loadAdmins = function() {
        $.ajax({
            url: 'controller/admins/retrieve-admins.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    let adminsInfo = $('#adminsInfo');
                    adminsInfo.empty();

                    response.admins.forEach(function(admin) {
                        let btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 admin-btn" data-id="${admin.id}">
                                    ${admin.last_name}, ${admin.first_name}
                                    </button>`;
                        adminsInfo.append(btn);
                    });
                } else {
                    console.error('Failed to load admins:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to load admins:', error);
            }
        });
    };

    loadAdmins();

    $(document).on('click', '.admin-btn', function() {
        const adminId = $(this).data('id');
        window.loadAdminDetails(adminId);
    });

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
                $('#admin_account_email').val(response.account_email).prop('disabled', false);
                $('#admin_password').val(response.password).prop('disabled', false);
                $('#role').val(response.role).prop('disabled', false);
                $('#adminUpdateBtn').prop('disabled', false);
            },
            error: function(xhr, status, error) {
                console.error('Error retrieving admin details:', error);
            }
        });
    };

    // Expose the function for updating the admin list
    window.refreshAdminList = loadAdmins;
});