document.getElementById('coorSubmitBtn').addEventListener('click', function (event) {
    event.preventDefault();

    const lastName = document.getElementById('coor_last_name').value;
    const firstName = document.getElementById('coor_first_name').value;
    const gender = document.getElementById('coor_gender').value;
    const address = document.getElementById('coor_address').value;
    const birthdate = document.getElementById('coor_birthdate').value;
    const civilStatus = document.getElementById('coor_civil_status').value;
    const personalEmail = document.getElementById('coor_personal_email').value;
    const contactNumber = document.getElementById('coor_contact_number').value;
    const department = document.getElementById('coor_department').value;
    const accountEmail = document.getElementById('coor_account_email').value;
    const password = document.getElementById('coor_password').value;

    // Check for empty required fields
    if (!lastName || !firstName || !gender || !address || !birthdate || !civilStatus ||
        !personalEmail || !contactNumber || !department || !accountEmail || !password) {
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
        middle_name: document.getElementById('coor_middle_name').value,
        suffix: document.getElementById('coor_suffix').value,
        gender: gender,
        address: address,
        birthdate: birthdate,
        civil_status: civilStatus,
        personal_email: personalEmail,
        contact_number: contactNumber,
        department: department,
        account_email: accountEmail,
        password: password
    };

    fetch('controller/coordinators/create-coor.php', {
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
                title: 'Coordinator added successfully!',
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