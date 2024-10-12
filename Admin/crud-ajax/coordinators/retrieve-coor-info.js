$(document).ready(function() {
    let isLoadingDetails = false;
    let currentAjaxRequest = null; // To store current AJAX request

    window.loadCoorDetails = function(id) {
        if (isLoadingDetails) return; // Prevent multiple clicks while loading
        isLoadingDetails = true;

        console.log('Loading coordinator details for ID:', id);
        loadDepartments(); // Load departments when fetching coordinator details

        // If there is an ongoing request, abort it
        if (currentAjaxRequest) {
            currentAjaxRequest.abort();
        }

        // Start new AJAX request for coordinator details
        currentAjaxRequest = $.ajax({
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
                $('#coor_address').val(response.address).prop('disabled', false);
                $('#coor_personal_email').val(response.personal_email).prop('disabled', false);
                $('#coor_employee_number').val(response.employee_number).prop('disabled', false);  // New field
                $('#coor_department').val(response.department_id).prop('disabled', false);
                $('#coor_account_email').val(response.account_email).prop('disabled', true);
                $('#coor_password').val(response.password).prop('disabled', true);
                $('#coorUpdateBtn').prop('disabled', false);
            },
            error: function(xhr, status, error) {
                // Only log errors if they weren't caused by an abort
                if (status !== 'abort') {
                    console.error('Error retrieving coordinator details:', error);
                }
            },
            complete: function() {
                isLoadingDetails = false; // Reset loading state after the request completes
            }
        });
    };

    // Handle click event for coordinator buttons
    $(document).on('click', '.coor-btn', function(e) {
        e.preventDefault();
        const coorId = $(this).data('id');
        window.loadCoorDetails(coorId); // Load details for clicked coordinator
    });
});