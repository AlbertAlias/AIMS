$(document).ready(function () {
    function loadVisor(searchTerm = '') {
        $.ajax({
            url: 'controller/supervisors/retrieve-visors.php',
            method: 'GET',
            data: { searchTerm: searchTerm },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    window.supervisors = response.supervisors;
                    updateSupervisorList(window.supervisors);
                } else {
                    console.warn('No supervisors found. Displaying empty list.');
                    updateSupervisorList([], response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Failed to load supervisor:', error);
                console.error('Response Text:', xhr.responseText);
            },
        });
    }

    function updateSupervisorList(supervisors, message = null) {
        let supervisorInfo = $('#supervisorInfo');
        supervisorInfo.empty();
    
        // If a message is passed, just show the image without the "No supervisors found" text
        if (message) {
            supervisorInfo.append(`
                <div class="text-center">
                    <img src="../assets/img/notfound.png" alt="No Coordinators Found" 
                         style="margin-top: 3px; margin-left: 8px; max-width: 40%; height: auto;">
                </div>
            `);
            return;
        }
    
        const limitedSupervisors = supervisors.slice(0, 10);
    
        // If there are no supervisors in the list, display the image only
        if (limitedSupervisors.length === 0) {
            supervisorInfo.append(`
                <div class="text-center">
                    <img src="../assets/img/notfound.png" alt="No Coordinators Found" 
                         style="margin-top: 3px; max-width: 39%; height: auto;">
                </div>
            `);
            return;
        }
    
        // If there are supervisors, display the supervisor buttons
        limitedSupervisors.forEach(function (supervisor) {
            let btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 visor-btn" data-id="${supervisor.id}">
                        ${supervisor.last_name}, ${supervisor.first_name}<br>${supervisor.company}
                        </button>`;
            supervisorInfo.append(btn);
        });
    }

    $('#searchSupervisors').on('input', function () {
        const searchTerm = $(this).val();
        loadVisor(searchTerm);
    });

    $(document).on('click', '.visor-btn', function () {
        var userId = $(this).data('id');
    
        $.ajax({
            url: 'controller/supervisors/retrieve-visors-info.php',
            method: 'GET',
            data: { user_id: userId },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#visorID').val(userId);
                    $('#visor_last_name').val(response.last_name);
                    $('#visor_first_name').val(response.first_name);
                    $('#visor_middle_name').val(response.middle_name);
                    $('#visor_gender').val(response.gender);
                    $('#visor_personal_email').val(response.email);
                    $('#visor_company_name').val(response.company);
                    $('#visor_company_address').val(response.company_address);
                    $('#visor_username').val(response.username);
                    $('#visorSubmitBtn').hide();
                    $('#visorUpdateBtn').show();
                    $('#visorCancelBtn').show();
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
    
        $.ajax({
            url: 'controller/supervisors/update-visors.php',
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
    
                    loadVisor();
                    $('#visorForm')[0].reset();
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
                console.error('Response Text:', xhr.responseText);
    
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

    $('#visorCancelBtn').click(function () {
        $('#visorForm')[0].reset();
        $('#visorSubmitBtn').show();
        $('#visorUpdateBtn').hide();
        $('#visorCancelBtn').hide();
    });
    

    loadVisor();
});