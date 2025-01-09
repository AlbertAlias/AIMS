function toggleContainerVisibility(triggerId, targetId) {
    const trigger = document.getElementById(triggerId);
    const target = document.getElementById(targetId);

    trigger.addEventListener('change', function () {
        target.style.display = this.value ? 'block' : 'none';
    });
}

toggleContainerVisibility('morningStartInput', 'lunchStartContainer');
toggleContainerVisibility('lunchBreakStartInput', 'lunchEndContainer');
toggleContainerVisibility('lunchBreakEndInput', 'afternoonEndContainer');

function calculateTotalHours() {
    const parseTime = time => {
        const [hours, minutes] = time.split(':').map(Number);
        return hours * 60 + minutes;
    };

    const morningStart = document.getElementById('morningStartInput').value;
    const lunchStart = document.getElementById('lunchBreakStartInput').value;
    const lunchEnd = document.getElementById('lunchBreakEndInput').value;
    const afternoonEnd = document.getElementById('afternoonEndInput').value;

    let totalMinutes = 0;

    if (morningStart && lunchStart) {
        const morningDuration = parseTime(lunchStart) - parseTime(morningStart);
        if (morningDuration < 0) {
            alert('Lunch Start cannot be earlier than Morning Start.');
            return;
        }
        totalMinutes += morningDuration;
    }

    if (lunchEnd && afternoonEnd) {
        const afternoonDuration = parseTime(afternoonEnd) - parseTime(lunchEnd);
        if (afternoonDuration < 0) {
            alert('Afternoon End cannot be earlier than Lunch End.');
            return;
        }
        totalMinutes += afternoonDuration;
    }

    const totalHoursInput = document.getElementById('totalHoursInput');
    const submitButton = document.getElementById('submitHoursButton');

    if (totalMinutes > 0) {
        const hours = Math.floor(totalMinutes / 60);
        const minutes = totalMinutes % 60;
        totalHoursInput.value = `${hours} hour(s) and ${minutes} minute(s)`;
        submitButton.disabled = false;
    } else {
        totalHoursInput.value = '';
        submitButton.disabled = true;
    }
}

document.querySelectorAll('input[type="time"]').forEach(input => {
    input.addEventListener('change', calculateTotalHours);
});
