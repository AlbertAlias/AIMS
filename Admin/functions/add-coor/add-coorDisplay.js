// Function to enable both coordinator and account information forms
function unlockAndResetForms() {
    // Reset and enable form elements in coordinatorForm
    const coordinatorForm = document.getElementById('coordinatorForm');
    const accountInfoForm = document.getElementById('accountInfoForm');
    
    if (coordinatorForm) {
        coordinatorForm.reset();
        document.querySelectorAll('#coordinatorForm input, #coordinatorForm select').forEach(el => el.disabled = false);
    }

    if (accountInfoForm) {
        accountInfoForm.reset();
        document.querySelectorAll('#accountInfoForm input').forEach(el => el.disabled = false);
    }

    // Enable buttons
    const submitBtn = document.getElementById('submitBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    
    if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.style.display = 'inline-block';
    }
    
    if (cancelBtn) cancelBtn.style.display = 'inline-block';
}

function disableAndResetForms() {
    const coordinatorForm = document.getElementById('coordinatorForm');
    const accountInfoForm = document.getElementById('accountInfoForm');
    
    if (coordinatorForm) {
        coordinatorForm.reset();
        document.querySelectorAll('#coordinatorForm input, #coordinatorForm select').forEach(el => el.disabled = true);
    }

    if (accountInfoForm) {
        accountInfoForm.reset();
        document.querySelectorAll('#accountInfoForm input').forEach(el => el.disabled = true);
    }

    // Hide buttons
    const submitBtn = document.getElementById('submitBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.style.display = 'inline-block';
    }
    
    if (cancelBtn) cancelBtn.style.display = 'none';
}

// Event listener for unlocking forms when "Add Coordinator" is clicked
document.getElementById('addCoordinatorsBtn').addEventListener('click', function() {
    unlockAndResetForms();
    loadDepartments(null, true);
});

// Event listener for unlocking forms when any coordinator button is clicked
document.getElementById('coordinatorInfo').addEventListener('click', function(event) {
    // Check if the clicked element is a coordinator button
    if (event.target && event.target.matches('button[data-id]')) {
        unlockAndResetForms();

        // Optional: Populate form with selected coordinator's data if needed
        const coordinatorId = event.target.getAttribute('data-id');
        console.log('Selected Coordinator ID:', coordinatorId);
        // You can add an AJAX request here to fetch and populate the coordinator's info
    }
});

// Event listener for the "Cancel" button
document.getElementById('cancelBtn').addEventListener('click', function() {
    disableAndResetForms(); // Lock forms when "Cancel" is clicked
    // Hide the "Cancel" button
    this.style.display = 'none';
});