$(document).ready(function () {
    $('#internUpdateBtn').off('click').on('click', function () {
        console.log('Update button clicked');

        const internID = $('#internID').val();
        const lastName = $('#intern_last_name').val();
        const firstName = $('#intern_first_name').val();
        const gender = $('#intern_gender').val();
        const address = $('#intern_address').val();
        const birthdate = $('#intern_birthdate').val();
        const civilStatus = $('#intern_civil_status').val();
        const personalEmail = $('#intern_personal_email').val();
        const contactNumber = $('#intern_contact_number').val();
        const studentID = $('#studentID').val();
        const department = $('#intern_department').val();
        const coordinator_name = $('#coordinator_name').val();
        const hours_needed = $('#hours_needed').val();
        const coordinator_email = $('#coordinator_email').val();
        const internship_status = $('#internship_status').val();
        const accountEmail = $('#intern_account_email').val();
        const password = $('#intern_password').val();

        if (!lastName || !firstName || !gender || !address || !birthdate || !civilStatus || !personalEmail || 
            !contactNumber || !studentID || !department || !coordinator_name || !hours_needed || !coordinator_email ||
            !internship_status || !accountEmail) {
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

        const data = {
            id: internID,
            intern_last_name: lastName,
            intern_first_name: firstName,
            intern_middle_name: $('#intern_middle_name').val(),
            intern_suffix: $('#intern_suffix').val(),
            intern_gender: gender,
            intern_address: address,
            intern_birthdate: birthdate,
            intern_civil_status: civilStatus,
            intern_personal_email: personalEmail,
            intern_contact_number: contactNumber,
            studentID: studentID,
            intern_department: department,
            coordinator_name: coordinator_name,
            hours_needed: hours_needed,
            coordinator_email: coordinator_email,
            internship_status: internship_status,
            intern_account_email: accountEmail,
            intern_password: password
        };

        $(this).prop('disabled', true);

        $.ajax({
            url: 'controller/interns/update-interns.php',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: 'Intern updated successfully!',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                    $('#internDeleteBtn').hide();
                    $('#internUpdateBtn').hide();
                    loadInterns();
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
                console.error('AJAX Error:', error);
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'error',
                    title: 'An error occurred while updating intern data. Please try again.',
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
                $('#internUpdateBtn').prop('disabled', false);
            }
        });
    });
});