$(document).ready(function () {
    let isSubmitting = false;

    // Remove any previous submit event listener and add a new one
    $('#internsForm').off('submit').on('submit', function (e) {
        e.preventDefault();

        // If already submitting, do not proceed
        if (isSubmitting) {
            return;
        }

        // Set the isSubmitting flag to true
        isSubmitting = true;
        $('#internSubmitBtn').prop('disabled', true);

        // Enable the necessary fields
        $('#intern_accountForm input:disabled').prop('disabled', false);
        $('#internsForm input:disabled, #internsForm select:disabled').prop('disabled', false);

        var formData = $(this).serialize() + '&' + $('#intern_accountForm').serialize();
        console.log('Form Data:', formData);

        $.ajax({
            url: 'controller/interns/create-interns.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                console.log('AJAX response:', response);
                if (response.success) {
                    // SweetAlert for successful intern creation
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Coordinator created successfully',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });

                    disableAndResetForms();
                    loadInterns();
                } else {
                    alert('Failed to add intern: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
                console.log('Response Text:', xhr.responseText);
                alert('An error occurred while processing the request: ' + xhr.responseText);
            },
            complete: function () {
                disableAndResetForms();
                $('#internsForm input').prop('disabled', true);
                $('#internsForm select').prop('disabled', true);
                $('#intern_accountForm input').prop('disabled', true);
                $('#internSubmitBtn').prop('disabled', false);
                isSubmitting = false; // Reset the submitting flag
            }
        });
    });
});


document.getElementById('internSubmitBtn').addEventListener('click', function (event) {
    event.preventDefault();

    const lastName = document.getElementById('intern_last_name').value;
    const firstName = document.getElementById('intern_first_name').value;
    const gender = document.getElementById('intern_gender').value;
    const address = document.getElementById('intern_address').value;
    const birthdate = document.getElementById('intern_birthdate').value;
    const civilStatus = document.getElementById('intern_civil_status').value;
    const personalEmail = document.getElementById('intern_personal_email').value;
    const contactNumber = document.getElementById('intern_contact_number').value;
    const studentId = document.getElementById('studentID').value;
    const department = document.getElementById('intern_department').value;
    const coorName = document.getElementById('coordinator_name').value;
    const hoursNeeded = document.getElementById('hours_needed').value;
    const coorEmail = document.getElementById('coordinator_email').value;
    const internStatus = document.getElementById('internship_status').value;
    const accountEmail = document.getElementById('intern_account_email').value;
    const password = document.getElementById('intern_password').value;

    // Check for empty required fields
    if (!lastName || !firstName || !gender || !address || !birthdate || !civilStatus ||
        !personalEmail || !contactNumber || !studentId || !coorName || !hoursNeeded ||
        !coorEmail || !internStatus || !department || !accountEmail || !password) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'Please fill in all required fields.',
            showConfirmButton: false,
            timer: 3000,
            background: '#f8d7da',
            iconColor: '#721c24',
            color: '#721c24',
            customClass: {
                popup: 'mt-5'
            }
        });
        return;
    }

    const data = {
        last_name: lastName,
        first_name: firstName,
        middle_name: document.getElementById('intern_middle_name').value,
        suffix: document.getElementById('intern_suffix').value,
        gender: gender,
        address: address,
        birthdate: birthdate,
        civil_status: civilStatus,
        personal_email: personalEmail,
        contact_number: contactNumber,
        studentID: studentId,
        department: department,
        coordinator_name: coorName,
        hours_needed: hoursNeeded,
        coordinator_email: coorEmail,
        internship_status: internStatus,
        account_email: accountEmail,
        password: password
    };

    fetch('controller/interns/create-interns.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => response.text())
    .then(rawResponse => JSON.parse(rawResponse))
    .then(data => {
        if (data.success) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Intern added successfully!',
                showConfirmButton: false,
                timer: 3000,
                background: '#b9f6ca',
                iconColor: '#2e7d32',
                color: '#155724',
                customClass: {
                    popup: 'mt-5'
                }
            });
            disableAndResetForms();
        } else {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: data.message,
                showConfirmButton: false,
                timer: 3000,
                background: '#f8d7da',
                iconColor: '#721c24',
                color: '#721c24',
                customClass: {
                    popup: 'mt-5'
                }
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'There was an error with the AJAX request.',
            showConfirmButton: false,
            timer: 3000,
            background: '#f8d7da',
            iconColor: '#721c24',
            color: '#721c24',
            customClass: {
                popup: 'mt-5'
            }
        });
    });
});