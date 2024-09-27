$(document).ready(function() {
    window.loadCoordinators = function() {
        $.ajax({
            url: 'controller/coordinators/retrieve-coor.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                let coordinatorInfo = $('#coordinatorInfo');
                coordinatorInfo.empty();

                response.forEach(function(coordinator) {
                    let btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 coordinator-btn" data-id="${coordinator.id}">
                                    ${coordinator.last_name}, ${coordinator.first_name}
                                </button>`;
                    coordinatorInfo.append(btn);
                });

                $('.coordinator-btn').on('click', function() {
                    const id = $(this).data('id');
                    window.loadCoorInfo(id); // Call the function to load coordinator info
                });
            },
            error: function(xhr, status, error) {
                console.error('Failed to load coordinators:', error);
            }
        });
    };

    window.loadCoorInfo = function(id) {
        $.ajax({
            url: 'controller/coordinators/retrieve-coor-info.php',
            method: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    console.error('Error:', response.error);
                    return;
                }

                $('#coorID').val(response.id);
                $('#coor_last_name').val(response.last_name).prop('disabled', false);
                $('#coor_first_name').val(response.first_name).prop('disabled', false);
                $('#coor_middle_name').val(response.middle_name).prop('disabled', false);
                $('#coor_suffix').val(response.suffix).prop('disabled', false);
                $('#coor_gender').val(response.gender).prop('disabled', false);
                $('#coor_address').val(response.address).prop('disabled', false);
                $('#coor_birthdate').val(response.birthdate).prop('disabled', false);
                $('#coor_civil_status').val(response.civil_status).prop('disabled', false);
                $('#coor_personal_email').val(response.personal_email).prop('disabled', false);
                $('#coor_contact_number').val(response.contact_number).prop('disabled', false);
                loadDepartments(response.department, true);
                $('#coor_account_email').val(response.account_email).prop('disabled', false);
                $('#coor_password').val(response.password).prop('disabled', false);
                $('#coorSubmitBtn').prop('disabled', false);
            },
            error: function(xhr, status, error) {
                console.error('Error retrieving coordinator details:', error);
            }
        });
    };

    loadCoordinators();
});