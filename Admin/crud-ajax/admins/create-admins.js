document.getElementById('adminSubmitBtn').addEventListener('click', function (event) {
    event.preventDefault();

    const lastName = document.getElementById('admin_last_name').value;
    const firstName = document.getElementById('admin_first_name').value;
    const gender = document.getElementById('admin_gender').value;
    const address = document.getElementById('admin_address').value;
    const birthdate = document.getElementById('admin_birthdate').value;
    const civilStatus = document.getElementById('admin_civil_status').value;
    const personalEmail = document.getElementById('admin_personal_email').value;
    const contactNumber = document.getElementById('admin_contact_number').value;
    const accountEmail = document.getElementById('admin_account_email').value;
    const password = document.getElementById('admin_password').value;
    const role = document.getElementById('role').value;

    if (!lastName || !firstName || !gender || !address || !birthdate || !civilStatus ||
        !personalEmail || !contactNumber || !accountEmail || !password || !role) {
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
        middle_name: document.getElementById('admin_middle_name').value,
        suffix: document.getElementById('admin_suffix').value,
        gender: gender,
        address: address,
        birthdate: birthdate,
        civil_status: civilStatus,
        personal_email: personalEmail,
        contact_number: contactNumber,
        account_email: accountEmail,
        password: password,
        role: role
    };

    fetch('controller/admins/create-admins.php', {
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
                title: 'Admin added successfully!',
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