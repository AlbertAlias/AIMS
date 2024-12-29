document.getElementById('morningStartInput').addEventListener('change', function () {
    const lunchStartContainer = document.getElementById('lunchStartContainer');
    if (this.value) {
        lunchStartContainer.style.display = 'block';
    }
});

document.getElementById('lunchBreakStartInput').addEventListener('change', function () {
    const lunchEndContainer = document.getElementById('lunchEndContainer');
    if (this.value) {
        lunchEndContainer.style.display = 'block';
    }
});

document.getElementById('lunchBreakEndInput').addEventListener('change', function () {
    const afternoonEndContainer = document.getElementById('afternoonEndContainer');
    if (this.value) {
        afternoonEndContainer.style.display = 'block';
    }
});

document.querySelectorAll('input[type="time"]').forEach(input => {
    input.addEventListener('change', calculateTotalHours);
});

function calculateTotalHours() {
    const parseTime = time => {
        const [hours, minutes] = time.split(':').map(Number);
        return hours * 60 + minutes; // Total minutes
    };

    const morningStart = document.getElementById('morningStartInput').value;
    const lunchStart = document.getElementById('lunchBreakStartInput').value;
    const lunchEnd = document.getElementById('lunchBreakEndInput').value;
    const afternoonEnd = document.getElementById('afternoonEndInput').value;

    let totalMinutes = 0;

    if (morningStart && lunchStart) {
        totalMinutes += parseTime(lunchStart) - parseTime(morningStart); // Morning hours
    }

    if (lunchEnd && afternoonEnd) {
        totalMinutes += parseTime(afternoonEnd) - parseTime(lunchEnd); // Afternoon hours
    }

    if (totalMinutes > 0) {
        const hours = Math.floor(totalMinutes / 60);
        const minutes = totalMinutes % 60;
        document.getElementById('totalHoursInput').value = `${hours} hour(s) and ${minutes} minute(s)`;
        document.getElementById('submitHoursButton').disabled = false;
    } else {
        document.getElementById('totalHoursInput').value = '';
        document.getElementById('submitHoursButton').disabled = true;
    }
}