$(document).ready(function () {
    $('#coorUpdateBtn').off('click').on('click', function () {
        $('#coordinatorForm input, #coordinatorForm select').prop('disabled', false);
        console.log('Update button clicked');

        const coorID = $('#coorID').val();
        const lastName = $('#coor_last_name').val();
        const firstName = $('#coor_first_name').val();
        const middleName = $('#coor_middle_name').val();
        const suffix = $('#coor_suffix').val();
        const gender = $('#coor_gender').val();
        const address = $('#coor_address').val();
        const birthdate = $('#coor_birthdate').val();
        const civilStatus = $('#coor_civil_status').val();
        const personalEmail = $('#coor_personal_email').val();
        const contactNumber = $('#coor_contact_number').val();
        const accountEmail = $('#coor_account_email').val();
        const password = $('#coor_password').val();
        const departmentID = $('#coor_department').val();

        // Remove validation for required fields
        const data = {
            id: coorID,
            coor_last_name: lastName,
            coor_first_name: firstName,
            coor_middle_name: middleName,
            coor_suffix: suffix,
            coor_gender: gender,
            coor_address: address,
            coor_birthdate: birthdate,
            coor_civil_status: civilStatus,
            coor_personal_email: personalEmail,
            coor_contact_number: contactNumber,
            coor_account_email: accountEmail,
            coor_password: password,
            coor_department: departmentID
        };

        $(this).prop('disabled', true);

        $.ajax({
            url: 'controller/coordinators/update-coor.php',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: 'Coordinator updated successfully!',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                    resetAndLockForms(); // Lock and reset the form after successful update
                    $('#coorDeleteBtn').hide();
                    $('#coorUpdateBtn').hide();
                    window.loadCoor();
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
                console.error('AJAX Error:', error);
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'error',
                    title: 'An error occurred while updating coordinator data. Please try again.',
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
                $('#coorUpdateBtn').prop('disabled', false);
            }
        });
    });
});