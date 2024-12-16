$(document).ready(function () {
    window.loadVisor = function () {
        $.ajax({
            url: 'controller/supervisors/retrieve-visors.php', // PHP script to fetch supervisors
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.success) {
                    // Store the fetched supervisors for filtering
                    window.supervisors = response.supervisors;
                    updateSupervisorList(window.supervisors);
                } else {
                    // Gracefully handle empty data
                    console.warn('No supervisors found. Displaying empty list.');
                    updateSupervisorList([], response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Failed to load supervisor:', error);
                console.error('Response Text:', xhr.responseText); // Debug response
            },
        });
    };

    // Function to update the Supervisor list
    function updateSupervisorList(supervisors, message = null) {
        let supervisorInfo = $('#supervisorInfo');
        supervisorInfo.empty();
    
        if (message) {
            supervisorInfo.append(`<div class="text-danger">${message}</div>`);
            return;
        }
    
        const limitedSupervisors = supervisors.slice(0, 10);
    
        if (limitedSupervisors.length === 0) {
            updateSupervisorList([], 'No supervisors found');
            return;
        }
    
        limitedSupervisors.forEach(function (supervisor) {
            let btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 visor-btn" data-id="${supervisor.id}">
                        ${supervisor.last_name}, ${supervisor.first_name}<br>${supervisor.company}
                        </button>`;
            supervisorInfo.append(btn);
        });
    }

    // When a supervisor button is clicked, fetch and populate their details
    $(document).on('click', '.visor-btn', function () {
        var userId = $(this).data('id'); // Get the ID of the selected supervisor
    
        $.ajax({
            url: 'controller/supervisors/retrieve-visors-info.php',
            method: 'GET',
            data: { user_id: userId },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.success) {
                    // Populate form fields with supervisor data
                    $('#visorID').val(userId);
                    $('#visor_last_name').val(response.last_name);
                    $('#visor_first_name').val(response.first_name);
                    $('#visor_middle_name').val(response.middle_name);
                    $('#visor_gender').val(response.gender);
                    $('#visor_personal_email').val(response.email);
                    $('#visor_company_name').val(response.company);
                    $('#visor_company_address').val(response.company_address);
                    $('#visor_username').val(response.username);
    
                    // Manage button visibility
                    $('#visorSubmitBtn').hide();   // Hide Submit button
                    $('#visorUpdateBtn').show();   // Show Update button
                    $('#visorCancelBtn').show();   // Show Cancel button
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            },
        });
    });

    $('#visorUpdateBtn').click(function () {
        const userData = {
            user_id: $('#visorID').val(),
            last_name: $('#visor_last_name').val(),
            first_name: $('#visor_first_name').val(),
            middle_name: $('#visor_middle_name').val(),
            gender: $('#visor_gender').val(),
            email: $('#visor_personal_email').val(),
            company: $('#visor_company_name').val(),
            company_address: $('#visor_company_address').val(),
            username: $('#visor_username').val(),
        };
    
        // Validate required fields (ignoring middle name and password)
        if (!userData.last_name || !userData.first_name || !userData.gender || !userData.email || 
            !userData.company || !userData.company_address || !userData.username) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Please fill in all the required fields!',
                showConfirmButton: false,
                timer: 3000,
                background: '#f8bbd0',
                iconColor: '#c62828',
                color: '#721c24',
                customClass: {
                    popup: 'mt-5'
                }
            });
            return;
        }
    
        // Send AJAX request to update supervisor details
        $.ajax({
            url: 'controller/supervisors/update-visors.php', // PHP script to handle updates
            method: 'POST',
            data: userData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Supervisor information updated successfully!',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
    
                    loadVisor(); // Reload the supervisor list
                    $('#visorForm')[0].reset(); // Reset the form
    
                    // Show Submit button and hide Update/Cancel buttons
                    $('#visorSubmitBtn').show();
                    $('#visorUpdateBtn').hide();
                    $('#visorCancelBtn').hide();
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: response.message || 'An unexpected error occurred.',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#f8bbd0',
                        iconColor: '#c62828',
                        color: '#721c24',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error('Error updating supervisor:', error);
                console.error('Response Text:', xhr.responseText); // Debugging info
    
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'An unexpected error occurred',
                    showConfirmButton: false,
                    timer: 3000,
                    background: '#f8bbd0',
                    iconColor: '#c62828',
                    color: '#721c24',
                    customClass: {
                        popup: 'mt-5'
                    }
                });
            },
        });
    });

    // Cancel the update and reset the form
    $('#visorCancelBtn').click(function () {
        // Reset the form fields
        $('#visorForm')[0].reset();
    
        // Ensure the visibility of buttons is properly toggled
        $('#visorSubmitBtn').show();  // Show Submit button
        $('#visorUpdateBtn').hide();  // Hide Update button
        $('#visorCancelBtn').hide();  // Hide Cancel button
    });
    

    loadVisor(); // Initially load the supervisor list
});