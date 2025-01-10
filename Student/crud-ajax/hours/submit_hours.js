document.getElementById('submitHoursButton').addEventListener('click', function (event) {
    event.preventDefault();

    const morningStart = document.getElementById('morningStartInput').value;
    const lunchStart = document.getElementById('lunchBreakStartInput').value;
    const lunchEnd = document.getElementById('lunchBreakEndInput').value;
    const afternoonEnd = document.getElementById('afternoonEndInput').value;
    const totalHours = document.getElementById('totalHoursInput').value;
    const ojtfile = document.getElementById('ojtfile').files[0];

    const formData = new FormData();
    formData.append('morningStart', morningStart);
    formData.append('lunchStart', lunchStart);
    formData.append('lunchEnd', lunchEnd);
    formData.append('afternoonEnd', afternoonEnd);
    formData.append('totalHours', totalHours);
    formData.append('ojtfile', ojtfile);

    fetch('controller/hours/submit_hours.php', {
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
                document.getElementById('lunchStartContainer').style.display = 'none';
                document.getElementById('lunchEndContainer').style.display = 'none';
                document.getElementById('afternoonEndContainer').style.display = 'none';
                document.getElementById('submitHoursButton').disabled = true;

                // Optionally, refresh the uploaded hours section or UI
                // fetchUploadedHours();
            } else {
                alert(data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while submitting your hours.');
        });
});
