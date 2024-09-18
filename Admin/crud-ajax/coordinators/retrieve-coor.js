$(document).ready(function() {
    // Function to load and display coordinators in buttons
    window.loadCoordinators = function() {
        $.ajax({
            url: 'controller/coordinators/retrieve-coor.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                let coordinatorInfo = $('#coordinatorInfo');
                coordinatorInfo.empty();  // Clear the div before populating

                response.forEach(function(coordinator) {
                    // Create a button for each coordinator
                    let btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 coordinator-btn" data-id="${coordinator.id}">${coordinator.first_name}</button>`;
                    coordinatorInfo.append(btn);
                });
            },
            error: function(xhr, status, error) {
                console.error('Failed to load coordinators:', error);
            }
        });
    };

    // Call loadCoordinators to load the data when the page is ready
    loadCoordinators();

    // Event handler for clicking a coordinator button
    $('#coordinatorInfo').on('click', '.coordinator-btn', function() {
        let coordinatorId = $(this).data('id');
        loadCoordinatorDetails(coordinatorId);  // Fetch coordinator details when a button is clicked
    });

    // Function to load coordinator details into the form
    function loadCoordinatorDetails(id) {
        $.ajax({
            url: 'controller/coordinators/retrieve-coor-details.php',
            method: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    console.error('Error:', response.error);
                    return;
                }

                // Populate Personal Information form (coordinatorForm)
                $('#coordinator_id').val(response.id);
                $('#first_name').val(response.first_name).prop('disabled', false);
                $('#last_name').val(response.last_name).prop('disabled', false);
                $('#middle_name').val(response.middle_name).prop('disabled', false);
                $('#suffix').val(response.suffix).prop('disabled', false);
                $('#address').val(response.address).prop('disabled', false);
                $('#birthdate').val(response.birthdate).prop('disabled', false);
                $('#personal_email').val(response.personal_email).prop('disabled', false);
                $('#contact_number').val(response.contact_number).prop('disabled', false);

                // Select the correct gender
                $('#gender').val(response.gender).prop('disabled', false);

                // Select the correct civil status
                $('#civil_status').val(response.civil_status).prop('disabled', false);

                // Populate Account Information form (accountInfoForm)
                $('#account_email').val(response.account_email).prop('disabled', false);
                $('#password').val(response.password).prop('disabled', false);

                // Enable submit button for the form
                $('#submitBtn').prop('disabled', false);

                // Load departments and select the user's department
                loadDepartments(response.department, true);
            },
            error: function(xhr, status, error) {
                console.error('Error retrieving coordinator details:', error);
            }
        });
    }    
});