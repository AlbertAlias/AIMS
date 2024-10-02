document.getElementById('internSubmitBtn').addEventListener('click', function (event) {
    event.preventDefault();
    const internSubmitBtn = document.getElementById('internSubmitBtn');

    if (internSubmitBtn.disabled) return;
    internSubmitBtn.disabled = true;

    const last_name = document.getElementById('intern_last_name').value;
    const first_name = document.getElementById('intern_first_name').value;
    const middle_name = document.getElementById('intern_middle_name').value;
    const suffix = document.getElementById('intern_suffix').value;
    const gender = document.getElementById('intern_gender').value;
    const address = document.getElementById('intern_address').value;
    const birthdate = document.getElementById('intern_birthdate').value;
    const civil_status = document.getElementById('intern_civil_status').value;
    const personal_email = document.getElementById('intern_personal_email').value;
    const contact_number = document.getElementById('intern_contact_number').value;
    const studentID = document.getElementById('studentID').value;
    const department_id = document.getElementById('intern_department').value;
    const coordinator_name = document.getElementById('coordinator_name').value;
    const coordinator_email = document.getElementById('coordinator_email').value;
    const internship_status = document.getElementById('internship_status').value;
    const hours_needed = document.getElementById('hours_needed').value;
    const account_email = document.getElementById('intern_account_email').value;
    const password = document.getElementById('intern_password').value;

    if (!last_name || !first_name || !gender || !address || !birthdate || !civil_status ||
        !personal_email || !contact_number || !studentID || !department_id || !coordinator_name ||
        !hours_needed || !coordinator_email || !internship_status || !account_email || !password) {
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
        internSubmitBtn.disabled = false; // Re-enable the submit button
        return;
    }

    const data = {
        last_name,
        first_name,
        middle_name,
        suffix,
        gender,
        address,
        birthdate,
        civil_status,
        personal_email,
        contact_number,
        studentID,
        department_id,
        coordinator_name,
        coordinator_email,
        internship_status,
        hours_needed,
        account_email,
        password
    };

    fetch('controller/interns/create-interns.php', {
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
            disableAndResetForms(); // Call this to reset and lock the forms
            window.setTimeout(() => {
                // Optionally redirect to the interns list or refresh the page
                // location.reload(); // Uncomment to refresh
            }, 3000);
        } else {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Intern with this email already exists.',
                showConfirmButton: false,
                timer: 3000,
                background: '#f8d7da',
                iconColor: '#721c24',
                color: '#721c24',
                customClass: {
                    popup: 'mt-5'
                }
            });
            internSubmitBtn.disabled = false; // Re-enable the submit button
        }
    })
    .catch((error) => {
        console.error('Error:', error);
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'An error occurred. Please try again.',
            showConfirmButton: false,
            timer: 3000,
            background: '#f8d7da',
            iconColor: '#721c24',
            color: '#721c24',
            customClass: {
                popup: 'mt-5'
            }
        });
        internSubmitBtn.disabled = false; // Re-enable the submit button
    });
});