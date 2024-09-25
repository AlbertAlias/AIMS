document.getElementById('adminSubmitBtn').addEventListener('click', function (event) {
    event.preventDefault(); // Prevent default form submission

    // Gather input values
    const adminID = document.getElementById('adminID').value;
    const adminLastName = document.getElementById('admin_last_name').value;
    const adminFirstName = document.getElementById('admin_first_name').value;
    const adminMiddleName = document.getElementById('admin_middle_name').value; // Optional
    const adminSuffix = document.getElementById('admin_suffix').value; // Optional
    const adminGender = document.getElementById('admin_gender').value;
    const adminAddress = document.getElementById('admin_address').value;
    const adminBirthdate = document.getElementById('admin_birthdate').value;
    const adminCivilStatus = document.getElementById('admin_civil_status').value;
    const adminContactNumber = document.getElementById('admin_contact_number').value;
    const adminPersonalEmail = document.getElementById('admin_personal_email').value;
    const adminAccountEmail = document.getElementById('admin_account_email').value;
    const adminPassword = document.getElementById('admin_password').value;
    const role = document.getElementById('role').value;

    // Validate required fields
    if (!adminLastName || !adminFirstName || !adminGender || !adminAddress || !adminBirthdate || !adminCivilStatus || !adminContactNumber || !adminPersonalEmail || !adminAccountEmail || !adminPassword || !role) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Please fill out all required fields.',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            background: '#f8d7da',
            iconColor: '#721c24',
            color: '#721c24',
            customClass: {
                popup: 'mt-5'
            }
        });
        return; // Stop further execution
    }

    // Prepare data for AJAX request
    const data = {
        id: adminID,
        admin_last_name: adminLastName,
        admin_first_name: adminFirstName,
        admin_middle_name: adminMiddleName, // Optional, can be null if not provided
        admin_suffix: adminSuffix, // Optional, can be null if not provided
        admin_gender: adminGender,
        admin_address: adminAddress,
        admin_birthdate: adminBirthdate,
        admin_civil_status: adminCivilStatus,
        admin_contact_number: adminContactNumber,
        admin_personal_email: adminPersonalEmail,
        admin_account_email: adminAccountEmail,
        admin_password: adminPassword, // Plain text to be hashed server-side
        role: role
    };

    // Perform the AJAX request using Fetch API
    fetch('controller/admins/create-admins.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        return response.json(); // Parse response as JSON
    })
    .then(data => {
        if (data.success) {
            // SweetAlert for success
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
            // SweetAlert for error (email already exists or general error)
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
        // SweetAlert for AJAX request error
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