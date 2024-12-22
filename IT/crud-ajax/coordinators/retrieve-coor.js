$(document).ready(function () {
    window.loadCoor = function () {
        $.ajax({
            url: 'controller/coordinators/retrieve-coor.php',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    window.coordinators = response.coordinators;
                    updateCoordinatorList(window.coordinators);
                } else {
                    console.warn('No coordinators found. Displaying empty list.');
                    updateCoordinatorList([], response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Failed to load coordinator:', error);
                console.error('Response Text:', xhr.responseText); 
            },
        });
    };

    // Function to update the coordinator list
    function updateCoordinatorList(coordinators, message = null) {
        let coordinatorInfo = $('#coordinatorInfo');
        coordinatorInfo.empty();

        if (message) {
            coordinatorInfo.append(`<div class="text-danger">${message}</div>`);
            return;
        }

        const limitedCoordinators = coordinators.slice(0, 10);

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
        var userId = $(this).data('id');

        $.ajax({
            url: 'controller/coordinators/retrieve-coor-info.php',
            method: 'GET',
            data: { user_id: userId },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#coorID').val(userId);
                    $('#coor_last_name').val(response.last_name);
                    $('#coor_first_name').val(response.first_name);
                    $('#coor_middle_name').val(response.middle_name);
                    $('#coor_personal_email').val(response.email);
                    $('#coor_username').val(response.username);

                    // Ensure "Choose Department" is always present, and set coordinator's department
                    setDepartment(response.department_id, response.department_name);

                    $('#coorSubmitBtn').hide();
                    $('#coorUpdateBtn').show();
                    $('#coorCancelBtn').show();
                } else {
                    console.warn('Coordinator not found.');
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
        // First, clear the select options, but always keep the "Choose Department" option
        $select.empty();
        $select.append('<option selected disabled>Choose Department</option>'); // Keep this option

        // Add the coordinator's department (this will remain as selected)
        $select.append(`<option value="${departmentId}" selected>${departmentName}</option>`);

        // Load remaining departments excluding the coordinator's department
        loadDepartments(departmentId); // Pass the coordinator's department ID to prevent it from being added again
    }

    // Update coordinator info when the Update button is clicked
    $('#coorUpdateBtn').click(function () {
        const userData = {
            user_id: $('#coorID').val(),
            last_name: $('#coor_last_name').val(),
            first_name: $('#coor_first_name').val(),
            middle_name: $('#coor_middle_name').val(),
            email: $('#coor_personal_email').val(),
            username: $('#coor_username').val(),
            password: $('#coor_password').val(),
            department_id: $('#coor_department').val(),
        };

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

        $.ajax({
            url: 'controller/coordinators/update-coor.php',
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

                    loadCoor();
                    $('#coordinatorForm')[0].reset();
                    $('#coor_department').prop('selectedIndex', 0);
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

    // Handle cancel button
    $('#coorCancelBtn').click(function () {
        $('#coordinatorForm')[0].reset();
        var $select = $('#coor_department');
        $select.empty();
        $select.append('<option selected disabled>Choose Department</option>');
        loadDepartments();
        $('#coorSubmitBtn').show();
        $('#coorUpdateBtn').hide();
        $('#coorCancelBtn').hide();
    });

    loadCoor(); // Initially load the coordinator list
});