$(document).ready(function () {
    // Prevent the Enter key from submitting the form
    $('#adminsForm').on('keypress', function (e) {
        if (e.which === 13) {  // Enter key code
            e.preventDefault();
            $('#adminUpdateBtn').click();  // Trigger the Update button click manually
        }
    });

    $('#adminUpdateBtn').off('click').on('click', function () {
        console.log('Update button clicked');
        const adminID = $('#adminID').val();
        const lastName = $('#admin_last_name').val();
        const firstName = $('#admin_first_name').val();
        const address = $('#admin_address').val();
        const civilStatus = $('#admin_civil_status').val();
        const personalEmail = $('#admin_personal_email').val();
        const employeeNumber = $('#admin_employee_number').val();
        const userType = $('#user_type').val();

        // Check for required fields
        if (!lastName || !firstName || !address || !civilStatus || !personalEmail || !employeeNumber || !userType) {
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'error',
                title: 'Please fill in all required fields.',
                showConfirmButton: false,
                timer: 3000,
                background: '#ffcccb',
                iconColor: '#c0392b',
                color: '#721c24',
                customClass: {
                    popup: 'mt-5'
                }
            });
            return;
        }

        // Prepare data to be sent
        const data = {
            id: adminID,
            admin_last_name: lastName,
            admin_first_name: firstName,
            admin_middle_name: $('#admin_middle_name').val(),
            admin_suffix: $('#admin_suffix').val(),
            admin_address: address,
            admin_civil_status: civilStatus,
            admin_personal_email: personalEmail,
            admin_employee_number: employeeNumber,
            user_type: userType
        };

        // Disable the button to prevent multiple submissions
        $(this).prop('disabled', true);

        $.ajax({
            url: 'controller/admins/update-admins.php',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: 'Admin updated successfully!',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                    $('#adminDeleteBtn').hide();
                    $('#adminUpdateBtn').hide();
                    $('#adminSubmitBtn').show().prop('disabled', true);
                    loadAdmins();
                    disableAndResetForms();
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'error',
                        title: 'Error: ' + response.message,
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#ffcccb',
                        iconColor: '#c0392b',
                        color: '#721c24',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', xhr.responseText);
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'error',
                    title: 'An error occurred while updating admin data. Please try again.',
                    showConfirmButton: false,
                    timer: 3000,
                    background: '#ffcccb',
                    iconColor: '#c0392b',
                    color: '#721c24',
                    customClass: {
                        popup: 'mt-5'
                    }
                });
            },
            complete: function () {
                $('#adminUpdateBtn').prop('disabled', false);
            }
        });
    });
});