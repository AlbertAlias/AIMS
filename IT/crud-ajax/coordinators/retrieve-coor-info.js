$(document).ready(function () {
    let isLoadingDetails = false;
    let currentAjaxRequest = null;

    window.loadCoorDetails = function (id) {
        if (isLoadingDetails) return; // Prevent multiple clicks while loading
        isLoadingDetails = true;

        console.log('Loading coordinator details for ID:', id);
        loadDepartments(); // Load departments when fetching coordinator details

        // If there is an ongoing request, abort it
        if (currentAjaxRequest) {
            currentAjaxRequest.abort();
        }

        currentAjaxRequest = $.ajax({
            url: 'controller/coordinators/retrieve-coor-info.php',
            method: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function (response) {
                console.log('Coordinator Details:', response);

                if (response.error) {
                    console.error('Error:', response.error);
                    return;
                }

                // Populate form fields
                $('#coorID').val(response.id);
                $('#coor_last_name').val(response.last_name).prop('disabled', false);
                $('#coor_first_name').val(response.first_name).prop('disabled', false);
                $('#coor_middle_name').val(response.middle_name).prop('disabled', false);
                $('#coor_address').val(response.address).prop('disabled', false);
                $('#coor_personal_email').val(response.personal_email).prop('disabled', false);
                $('#coor_employee_no').val(response.employee_no).prop('disabled', false);
                $('#coor_department').val(response.department_id).prop('disabled', false);
                $('#coor_username').val(response.username).prop('disabled', false);
                $('#coor_password').val('').prop('disabled', false);
                $('#coorUpdateBtn').prop('disabled', false);
            },
            error: function (xhr, status, error) {
                if (status !== 'abort') {
                    console.error('Error retrieving coordinator details:', error);
                }
            },
            complete: function () {
                isLoadingDetails = false;
            },
        });
    };

    $(document).on('click', '.coor-btn', function (e) {
        e.preventDefault();
        const coorId = $(this).data('id');
        window.loadCoorDetails(coorId);
    });
});