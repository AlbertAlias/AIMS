document.getElementById('coorSubmitBtn').addEventListener('click', function (event) {
    event.preventDefault();

    const coorSubmitBtn = document.getElementById('coorSubmitBtn');

    // Check if button is already disabled to prevent double submission
    if (coorSubmitBtn.disabled) return;

    coorSubmitBtn.disabled = true; // Disable the button to prevent double submission.

    const last_name = document.getElementById('coor_last_name').value;
    const first_name = document.getElementById('coor_first_name').value;
    const gender = document.getElementById('coor_gender').value;
    const address = document.getElementById('coor_address').value;
    const birthdate = document.getElementById('coor_birthdate').value;
    const civil_status = document.getElementById('coor_civil_status').value;
    const personal_email = document.getElementById('coor_personal_email').value;
    const contact_number = document.getElementById('coor_contact_number').value;
    const department = document.getElementById('coor_department').value;
    const account_email = document.getElementById('coor_account_email').value;
    const password = document.getElementById('coor_password').value;

    // Check for empty required fields
    if (!last_name || !first_name || !gender || !address || !birthdate || !civil_status ||
        !personal_email || !contact_number || !department || !account_email || !password) {
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
        coorSubmitBtn.disabled = false; // Re-enable button if validation fails
        return;
    }

    const data = {
        last_name,
        first_name,
        middle_name: document.getElementById('coor_middle_name').value,
        suffix: document.getElementById('coor_suffix').value,
        gender,
        address,
        birthdate,
        civil_status,
        personal_email,
        contact_number,
        department,
        account_email,
        password
    };

    fetch('controller/coordinators/create-coor.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data) // Send JSON-encoded data
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
            disableAndResetForms();

            // Call the function to dynamically load the updated list of coordinators
            window.loadCoordinators(); // Update this line

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
        coorSubmitBtn.disabled = false; // Re-enable after submission completes
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
        coorSubmitBtn.disabled = false; // Re-enable if AJAX request fails
    });
});