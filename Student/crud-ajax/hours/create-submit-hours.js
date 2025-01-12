document.getElementById('submitHoursButton').addEventListener('click', function (event) {
    event.preventDefault();

    const ojtfile = document.getElementById('ojtfile').files[0];

    if (ojtfile) {
        // Check file size (5MB max)
        if (ojtfile.size > 5000000) {  // 5 MB
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'error',
                title: 'File too large! Maximum size is 5MB.',
                showConfirmButton: false,
                timer: 2000,
                background: '#ffebee',
                iconColor: '#d32f2f',
                color: '#b71c1c',
                customClass: {
                    popup: 'mt-5'
                }
            });
            return;
        }

        // Check file type
        const fileType = ojtfile.type;
        if (!["application/pdf", "image/jpeg", "image/png"].includes(fileType)) {
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'error',
                title: 'Invalid file type! Only PDF, JPG, JPEG, and PNG are allowed.',
                showConfirmButton: false,
                timer: 2000,
                background: '#ffebee',
                iconColor: '#d32f2f',
                color: '#b71c1c',
                customClass: {
                    popup: 'mt-5'
                }
            });
            return;
        }
    }

    // Proceed with form submission
    const morningStart = document.getElementById('morningStartInput').value;
    const lunchStart = document.getElementById('lunchBreakStartInput').value;
    const lunchEnd = document.getElementById('lunchBreakEndInput').value;
    const afternoonEnd = document.getElementById('afternoonEndInput').value;
    const totalHours = document.getElementById('totalHoursInput').value;

    const formData = new FormData();
    formData.append('morningStart', morningStart);
    formData.append('lunchStart', lunchStart);
    formData.append('lunchEnd', lunchEnd);
    formData.append('afternoonEnd', afternoonEnd);
    formData.append('totalHours', totalHours);
    formData.append('ojtfile', ojtfile);

    fetch('controller/hours/create-submit-hours.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show SweetAlert success message
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'success',
                title: 'File uploaded successfully!',
                showConfirmButton: false,
                timer: 2000,
                background: '#b9f6ca',
                iconColor: '#2e7d32',
                color: '#155724',
                customClass: {
                    popup: 'mt-5'
                }
            });

            // Reset inputs
            document.getElementById('morningStartInput').value = '';
            document.getElementById('lunchBreakStartInput').value = '';
            document.getElementById('lunchBreakEndInput').value = '';
            document.getElementById('afternoonEndInput').value = '';
            document.getElementById('totalHoursInput').value = '';
            document.getElementById('ojtfile').value = '';

            // Hide fields and reset button state
            document.getElementById('lunchStartContainer').style.display = 'none';
            document.getElementById('lunchEndContainer').style.display = 'none';
            document.getElementById('afternoonEndContainer').style.display = 'none';
            document.getElementById('submitHoursButton').disabled = true;

            loadOjtHoursData();
        } else {
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'error',
                title: data.error || 'Submission failed.',
                showConfirmButton: false,
                timer: 2000,
                background: '#ffebee',
                iconColor: '#d32f2f',
                color: '#b71c1c',
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
            position: 'top-right',
            icon: 'error',
            title: 'An error occurred while submitting your hours.',
            showConfirmButton: false,
            timer: 2000,
            background: '#ffebee',
            iconColor: '#d32f2f',
            color: '#b71c1c',
            customClass: {
                popup: 'mt-5'
            }
        });
    });
});