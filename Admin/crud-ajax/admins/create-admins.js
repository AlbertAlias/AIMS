document.getElementById('adminSubmitBtn').addEventListener('click', function (event) {
    event.preventDefault();
    const adminSubmitBtn = document.getElementById('adminSubmitBtn');

    if (adminSubmitBtn.disabled) return;
    adminSubmitBtn.disabled = true;

    const last_name = document.getElementById('admin_last_name').value;
    const first_name = document.getElementById('admin_first_name').value;
    const middle_name = document.getElementById('admin_middle_name').value;
    const suffix = document.getElementById('admin_suffix').value;
    const address = document.getElementById('admin_address').value;
    const employee_number = document.getElementById('admin_employee_number').value;
    const personal_email = document.getElementById('admin_personal_email').value;
    const account_email = document.getElementById('admin_account_email').value;
    const password = document.getElementById('admin_password').value;
    const user_type = document.getElementById('user_type').value;

    // Check for empty required fields
    if (!last_name || !first_name || !employee_number || !address || !personal_email || !account_email || !password || !user_type) {
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
        adminSubmitBtn.disabled = false;
        return;
    }

    const data = {
        last_name,
        first_name,
        middle_name,
        suffix,
        address,
        employee_number,
        personal_email,
        account_email,
        password,
        user_type
    };

    fetch('controller/admins/create-admins.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
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
            window.loadAdmins();
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
        adminSubmitBtn.disabled = false;
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
        adminSubmitBtn.disabled = false;
    });
});