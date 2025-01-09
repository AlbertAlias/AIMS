$(document).ready(function () {
    window.loadRegistrar = function (searchTerm = '') {
        $.ajax({
            url: 'controller/registrar/retrieve-registrar.php',
            method: 'GET',
            data: { searchTerm: searchTerm },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    window.registrar = response.registrar;
                    updateRegistrarList(window.registrar);
                } else {
                    console.warn('No registrar found. Displaying empty list.');
                    updateRegistrarList([], response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Failed to load registrar:', error);
                console.error('Response Text:', xhr.responseText);
            },
        });
    };

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

    $('#searchRegistrar').on('input', function () {
        const searchTerm = $(this).val();
        loadRegistrar(searchTerm);
    });

    $(document).on('click', '.registrar-btn', function () {
        var userId = $(this).data('id');

        $.ajax({
            url: 'controller/registrar/retrieve-registrar-info.php',
            method: 'GET',
            data: { user_id: userId },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#registrarID').val(userId);
                    $('#registrar_last_name').val(response.last_name);
                    $('#registrar_first_name').val(response.first_name);
                    $('#registrar_personal_email').val(response.email);
                    $('#registrar_username').val(response.username);
                    $('#registrarSubmitBtn').hide();
                    $('#registrarUpdateBtn').show();
                    $('#registrarCancelBtn').show();
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

        if (!userData.last_name || !userData.first_name || !userData.email || !userData.username) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Please fill in all the required fields!',
                showConfirmButton: false,
                timer: 2000,
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
            url: 'controller/registrar/update-registrar.php',
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
                        timer: 2000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });

                    loadRegistrar();
                    $('#registrarForm')[0].reset();
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
                        timer: 2000,
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
                console.error('Response Text:', xhr.responseText);

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'An unexpected error occurred',
                    showConfirmButton: false,
                    timer: 2000,
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

    $('#registrarCancelBtn').click(function () {
        $('#registrarForm')[0].reset();
        $('#registrarSubmitBtn').show();
        $('#registrarUpdateBtn').hide();
        $('#registrarCancelBtn').hide();
    });

    loadRegistrar();
});