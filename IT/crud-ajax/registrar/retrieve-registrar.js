$(document).ready(function () {
    window.loadRegistrar = function () {
        $.ajax({
            url: 'controller/registrar/retrieve-registrar.php', // PHP script to fetch registrar
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.success) {
                    // Store the fetched registrar for filtering
                    window.registrar = response.registrar;
                    updateRegistrarList(window.registrar);
                } else {
                    // Gracefully handle empty data
                    console.warn('No registrar found. Displaying empty list.');
                    updateRegistrarList([], response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Failed to load registrar:', error);
                console.error('Response Text:', xhr.responseText); // Debug response
            },
        });
    };

    // Function to update the Registrar list
    function updateRegistrarList(registrar, message = null) {
        let registrarInfo = $('#registrarInfo');
        registrarInfo.empty();
    
        if (message) {
            registrarInfo.append(`<div class="text-danger">${message}</div>`);
            return;
        }
    
        const limitedRegistrar = registrar.slice(0, 10);
    
        if (limitedRegistrar.length === 0) {
            updateRegistrarList([], 'No registrar found');
            return;
        }
    
        limitedRegistrar.forEach(function (registrar) {
            let btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 registrar-btn" data-id="${registrar.id}">
                        ${registrar.last_name}, ${registrar.first_name}
                        </button>`;
            registrarInfo.append(btn);
        });
    }

    // When a registrar button is clicked, fetch and populate their details
    $(document).on('click', '.registrar-btn', function () {
        var userId = $(this).data('id'); // Get the ID of the selected registrar
    
        $.ajax({
            url: 'controller/registrar/retrieve-registrar-info.php',
            method: 'GET',
            data: { user_id: userId },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.success) {
                    // Populate form fields with registrar data
                    $('#registrarID').val(userId);
                    $('#registrar_last_name').val(response.last_name);
                    $('#registrar_first_name').val(response.first_name);
                    $('#registrar_personal_email').val(response.email);
                    $('#registrar_username').val(response.username);
    
                    // Manage button visibility
                    $('#registrarSubmitBtn').hide();   // Hide Submit button
                    $('#registrarUpdateBtn').show();   // Show Update button
                    $('#registrarCancelBtn').show();   // Show Cancel button
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            },
        });
    });

    $('#registrarUpdateBtn').click(function () {
        const userData = {
            user_id: $('#registrarID').val(),
            last_name: $('#registrar_last_name').val(),
            first_name: $('#registrar_first_name').val(),
            email: $('#registrar_personal_email').val(),
            username: $('#registrar_username').val(),
        };
    
        // Validate required fields (ignoring middle name and password)
        if (!userData.last_name || !userData.first_name || !userData.email || !userData.username) {
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
    
        // Send AJAX request to update registrar details
        $.ajax({
            url: 'controller/registrar/update-registrar.php', // PHP script to handle updates
            method: 'POST',
            data: userData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Registrar information updated successfully!',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
    
                    loadRegistrar(); // Reload the registrar list
                    $('#registrarForm')[0].reset(); // Reset the form
    
                    // Show Submit button and hide Update/Cancel buttons
                    $('#registrarSubmitBtn').show();
                    $('#registrarUpdateBtn').hide();
                    $('#registrarCancelBtn').hide();
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
                console.error('Error updating registrar:', error);
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
    $('#registrarCancelBtn').click(function () {
        // Reset the form fields
        $('#registrarForm')[0].reset();
    
        // Ensure the visibility of buttons is properly toggled
        $('#registrarSubmitBtn').show();  // Show Submit button
        $('#registrarUpdateBtn').hide();  // Hide Update button
        $('#registrarCancelBtn').hide();  // Hide Cancel button
    });
    

    loadRegistrar(); // Initially load the registrar list
});