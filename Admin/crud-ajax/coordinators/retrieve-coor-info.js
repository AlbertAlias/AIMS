$(document).ready(function() {
    let isLoadingDetails = false;

    window.loadCoorDetails = function(id) {
        if (isLoadingDetails) return; 
        isLoadingDetails = true;

        console.log('Loading coordinator details for ID:', id);
        loadDepartments(); // Load departments when fetching coordinator details
        $.ajax({
            url: 'controller/coordinators/retrieve-coor-info.php',
            method: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                console.log('Coordinator Details:', response);

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
                $('#coor_department').val(response.department_id).prop('disabled', false);
                $('#coor_account_email').val(response.account_email).prop('disabled', true);
                $('#coor_password').val(response.password).prop('disabled', true);
                $('#coorUpdateBtn').prop('disabled', false);
            },
            error: function(xhr, status, error) {
                console.error('Error retrieving coordinator details:', error);
            },
            complete: function() {
                isLoadingDetails = false; 
            }
        });
    };

    $(document).on('click', '.coor-btn', function(e) {
        e.preventDefault();
        const coorId = $(this).data('id');
        window.loadCoorDetails(coorId);
    });
});