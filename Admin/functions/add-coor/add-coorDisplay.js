document.getElementById('addCoordinatorsBtn').addEventListener('click', function() {
    // Enable all form inputs
    const inputs = document.querySelectorAll('#coordinatorForm input, #coordinatorForm select, #submitBtn, #account-email, #password');
    inputs.forEach(input => {
        input.disabled = false;
    });
});