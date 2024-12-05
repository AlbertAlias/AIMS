document.getElementById('coorSubmitBtn').addEventListener('click', function (event) {
    event.preventDefault();

    const coorSubmitBtn = document.getElementById('coorSubmitBtn');

    // Prevent double submission
    if (coorSubmitBtn.disabled) return;

    const last_name = document.getElementById('coor_last_name').value;
    const first_name = document.getElementById('coor_first_name').value;
    const middle_name = document.getElementById('coor_middle_name').value;
    const employee_no = document.getElementById('coor_employee_no').value;
    const address = document.getElementById('coor_address').value;
    const personal_email = document.getElementById('coor_personal_email').value;
    const department_id = document.getElementById('coor_department').value;
    const username = document.getElementById('coor_username').value;
    const password = document.getElementById('coor_password').value;

    // Validation for required fields
    if (!last_name || !first_name || !employee_no || !address || !personal_email || !department_id || !username || !password) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'Please fill in all required fields.',
            showConfirmButton: false,
            timer: 3000
        });
        return;
    }

    const data = {
        last_name,
        first_name,
        middle_name,
        employee_no,
        address,
        personal_email,
        department_id,
        username,
        password
    };

    fetch('controller/coordinators/create-coor.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => response.text()) // Capture raw response as text
    .then(text => {
        console.log('Raw response:', text); // Log the raw response
        try {
            const data = JSON.parse(text); // Parse it after inspecting
            if (data.success) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Coordinator added successfully!',
                    showConfirmButton: false,
                    timer: 3000
                });
                resetAndLockForms();
                window.loadCoor();
            } else {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        } catch (error) {
            console.error('Error parsing response:', error);
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'There was an error with the AJAX response.',
                showConfirmButton: false,
                timer: 3000
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
            timer: 3000
        });
    });
});