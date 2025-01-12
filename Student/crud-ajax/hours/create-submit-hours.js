document.getElementById('submitHoursButton').addEventListener('click', function (event) {
    event.preventDefault();

    const ojtfile = document.getElementById('ojtfile').files[0];
    
    if (ojtfile) {
        // Check file size (10MB max)
        if (ojtfile.size > 10000000) {  // 10 MB
            alert("Sorry, your file is too large.");
            return;
        }

        // Check file type
        const fileType = ojtfile.type;
        if (!["application/pdf", "image/jpeg", "image/png"].includes(fileType)) {
            alert("Sorry, only PDF, JPG, JPEG, and PNG files are allowed.");
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
            alert(data.success);
            document.getElementById('morningStartInput').value = '';
            document.getElementById('lunchBreakStartInput').value = '';
            document.getElementById('lunchBreakEndInput').value = '';
            document.getElementById('afternoonEndInput').value = '';
            document.getElementById('totalHoursInput').value = '';
            document.getElementById('ojtfile').value = '';
            document.getElementById('submitHoursButton').disabled = true;
            loadOjtHoursData();
        } else {
            alert(data.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while submitting your hours.');
    });
});