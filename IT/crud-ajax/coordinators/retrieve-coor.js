$(document).ready(function () {
    window.loadCoor = function () {
        $.ajax({
            url: 'controller/coordinators/retrieve-coor.php', // PHP script to fetch coordinators
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Store the fetched coordinators for filtering
                    window.coordinators = response.coordinators;
                    updateCoordinatorList(window.coordinators);
                } else {
                    // Gracefully handle empty data
                    console.warn('No coordinators found. Displaying empty list.');
                    updateCoordinatorList([], response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Failed to load coordinator:', error);
                console.error('Response Text:', xhr.responseText); // Debug response
            },
        });
    };

    // Function to update the coordinator list
    function updateCoordinatorList(coordinators, message = null) {
        let coordinatorInfo = $('#coordinatorInfo');
        coordinatorInfo.empty();

        // If a message is provided, display it
        if (message) {
            coordinatorInfo.append(`<div class="text-danger">${message}</div>`);
            return;
        }

        // Limit the number of coordinators displayed to 10
        const limitedCoordinators = coordinators.slice(0, 10);

        // If no coordinators found, display a message
        if (limitedCoordinators.length === 0) {
            updateCoordinatorList([], 'No coordinators found');
            return;
        }

        limitedCoordinators.forEach(function (coordinator) {
            let btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 coor-btn" data-id="${coordinator.id}">
                        ${coordinator.last_name}, ${coordinator.first_name}<br>${coordinator.department_name}
                        </button>`;
            coordinatorInfo.append(btn);
        });
    }

    // When a coordinator button is clicked, fetch and populate their details
    $(document).on('click', '.coor-btn', function () {
        var userId = $(this).data('id'); // Get the ID of the selected coordinator
    
        $.ajax({
            url: 'controller/coordinators/retrieve-coor-info.php',
            method: 'GET',
            data: { user_id: userId },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Populate the form fields with the coordinator's details
                    $('#coorID').val(userId);
                    $('#coor_last_name').val(response.last_name);
                    $('#coor_first_name').val(response.first_name);
                    $('#coor_middle_name').val(response.middle_name);
                    $('#coor_personal_email').val(response.email);
                    $('#coor_username').val(response.username);
    
                    // Set the coordinator's department
                    setDepartment(response.department_id, response.department_name);
    
                    // Show the Update and Cancel buttons, and hide the Submit button
                    $('#coorSubmitBtn').hide();
                    $('#coorUpdateBtn').show();
                    $('#coorCancelBtn').show();
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            },
        });
    });
    
    
    // Function to set the coordinator's department (populate and pre-select it)
    function setDepartment(departmentId, departmentName) {
        var $select = $('#coor_department');
        
        // First clear all options in the select dropdown, except for the 'Choose Department' option
        $select.empty();
    
        // Add the "Choose Department" option
        $select.append('<option selected disabled>Choose Department</option>');
    
        // Add the department of the coordinator (this will remain as selected)
        $select.append('<option value="' + departmentId + '" selected>' + departmentName + '</option>');
    
        // Call loadDepartments to add the available departments that do not belong to the coordinator
        loadDepartments(departmentId); // Pass the coordinator's department ID to prevent it from being added again
    }

    $('#coorUpdateBtn').click(function () {
        const userData = {
            user_id: $('#coorID').val(),
            last_name: $('#coor_last_name').val(),
            first_name: $('#coor_first_name').val(),
            middle_name: $('#coor_middle_name').val(),
            email: $('#coor_personal_email').val(),
            username: $('#coor_username').val(),
            department_id: $('#coor_department').val(),
        };
    
        // Validate required fields
        if (!userData.last_name || !userData.first_name || !userData.email || !userData.username || !userData.department_id) {
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
    
        // Send AJAX request to update coordinator details
        $.ajax({
            url: 'controller/coordinators/update-coor.php', // PHP script to handle updates
            method: 'POST',
            data: userData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Coordinator information updated successfully!',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
    
                    loadCoor(); // Reload the coordinator list
                    $('#coordinatorForm')[0].reset(); // Reset the form
    
                    // Reset the select to the default option
                    $('#coor_department').prop('selectedIndex', 0); // This resets to "Choose Department"
    
                    // Show Submit button and hide Update/Cancel buttons
                    $('#coorSubmitBtn').show();
                    $('#coorUpdateBtn').hide();
                    $('#coorCancelBtn').hide();
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
                console.error('Error updating coordinator:', error);
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
    $('#coorCancelBtn').click(function () {
        // Reset the form fields
        $('#coordinatorForm')[0].reset();
    
        // Reset the department dropdown to its default state
        var $select = $('#coor_department');
        $select.empty();  // Clear the current options
        $select.append('<option selected disabled>Choose Department</option>'); // Add the default "Choose Department" option
    
        // Call loadDepartments() to repopulate the department dropdown
        loadDepartments(); // Reload available departments
    
        // Hide the Update and Cancel buttons, and show the Submit button
        $('#coorSubmitBtn').show();
        $('#coorUpdateBtn').hide();
        $('#coorCancelBtn').hide();
    });
    

    loadCoor(); // Initially load the coordinator list
});