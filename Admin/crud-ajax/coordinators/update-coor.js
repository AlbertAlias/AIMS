$(document).ready(function() {
    // Intercept Enter key press
    $('#coordinatorForm').on('keypress', function(event) {
        if (event.which === 13) {  // 13 is the Enter key
            event.preventDefault();  // Prevent form submission on Enter key

            // Trigger the update button click
            $('#coorUpdateBtn').click();
        }
    });

    $('#coorUpdateBtn').off('click').on('click', function() {
        $('#coordinatorForm input, #coordinatorForm select').prop('disabled', false);
        console.log('Update button clicked');

        const coorID = $('#coorID').val();
        const lastName = $('#coor_last_name').val();
        const firstName = $('#coor_first_name').val();
        const middleName = $('#coor_middle_name').val();
        const suffix = $('#coor_suffix').val();
        const address = $('#coor_address').val();
        const personalEmail = $('#coor_personal_email').val();
        const employeeNumber = $('#coor_employee_number').val();
        const departmentID = $('#coor_department').val();

        const data = {
            id: coorID,
            coor_last_name: lastName,
            coor_first_name: firstName,
            coor_middle_name: middleName,
            coor_suffix: suffix,
            coor_address: address,
            coor_personal_email: personalEmail,
            coor_employee_number: employeeNumber,
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
