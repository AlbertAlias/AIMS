$(document).ready(function() {
    window.loadCoor = function() {
        $.ajax({
            url: 'controller/coordinators/retrieve-coor.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    let coordinatorInfo = $('#coordinatorInfo');
                    coordinatorInfo.empty();

                    response.coordinators.forEach(function(coordinator) {
                        let btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 coor-btn" data-id="${coordinator.id}">
                                    ${coordinator.last_name}, ${coordinator.first_name}
                                    </button>`;
                        coordinatorInfo.append(btn);
                    });
                } else {
                    console.error('Failed to load coordinator:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to load coordinator:', error);
            }
        });
    };

    loadCoor();

    window.loadCoorDetails = function(id) {
        console.log('Loading coordinator details for ID:', id);
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

                // Populate the form with coordinator details
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
                $('#coor_department').val(response.department_id).prop('disabled', false);
                $('#coor_account_email').val(response.account_email).prop('disabled', false);
                $('#coor_password').val(response.password).prop('disabled', false);
                $('#coorUpdateBtn').prop('disabled', false);
            },
            error: function(xhr, status, error) {
                console.error('Error retrieving coordinator details:', error);
            }
        });
    };

    $(document).on('click', '.coor-btn', function() {
        const coorId = $(this).data('id');
        window.loadCoorDetails(coorId);
    });
    
    // Expose the function for updating the coordinator list
    window.refreshCoorList = loadCoor;
});