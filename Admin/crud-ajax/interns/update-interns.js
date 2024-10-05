document.getElementById("internUpdateBtn").addEventListener("click", function () {
    const internsForm = document.getElementById("internsForm");
    const formData = new FormData(internsForm);

    // Enable the department select so it can be sent with the form
    document.getElementById("intern_department").disabled = false;

    // Ensure the department, email, and password fields are sent
    formData.append("intern_department", document.getElementById("intern_department").value);
    formData.append("intern_account_email", document.getElementById("intern_account_email").value);
    formData.append("intern_password", document.getElementById("intern_password").value);

    // Add action to the formData
    formData.append("action", "update_intern");

    fetch('controller/interns/update-interns.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Intern updated successfully!',
                showConfirmButton: false,
                timer: 3000,
                background: '#b9f6ca',
                iconColor: '#2e7d32',
                color: '#155724',
                customClass: { popup: 'mt-5' }
            });
            updateFormResetAndLock();
            fetchInterns();
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
                customClass: { popup: 'mt-5' }
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'An error occurred while updating intern.',
            showConfirmButton: false,
            timer: 3000,
            background: '#f8d7da',
            iconColor: '#721c24',
            color: '#721c24',
            customClass: { popup: 'mt-5' }
        });
    });
});