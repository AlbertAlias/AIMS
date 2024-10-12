document.getElementById('coorSubmitBtn').addEventListener('click', function (event) {
    event.preventDefault();

    const coorSubmitBtn = document.getElementById('coorSubmitBtn');

    // Prevent double submission
    if (coorSubmitBtn.disabled) return;

    const last_name = document.getElementById('coor_last_name').value;
    const first_name = document.getElementById('coor_first_name').value;
    const middle_name = document.getElementById('coor_middle_name').value;
    const suffix = document.getElementById('coor_suffix').value;
    const employee_number = document.getElementById('coor_employee_number').value; // New field
    const address = document.getElementById('coor_address').value;
    const civil_status = document.getElementById('coor_civil_status').value;
    const personal_email = document.getElementById('coor_personal_email').value;
    const department_id = document.getElementById('coor_department').value;
    const account_email = document.getElementById('coor_account_email').value;
    const password = document.getElementById('coor_password').value;

    // Validation for required fields
    if (!last_name || !first_name || !employee_number || !address || !civil_status ||
        !personal_email || !department_id || !account_email || !password) {
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
        last_name,
        first_name,
        middle_name,
        suffix,
        employee_number, // New field
        address,
        civil_status,
        personal_email,
        department_id,
        account_email,
        password
    };

    fetch('controller/coordinators/create-coor.php', {
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
            resetAndLockForms();
            window.loadCoor();
            coorSubmitBtn.disabled = true;
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