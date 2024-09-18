// Function to show Update button and hide Submit button
function showUpdateButton() {
    const updateBtn = document.getElementById('updateBtn');
    const submitBtn = document.getElementById('submitBtn');

    if (updateBtn) updateBtn.style.display = 'inline-block';  // Show the update button
    if (submitBtn) submitBtn.style.display = 'none';          // Hide the submit button
}

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

    // Reset and disable the department select
    const departmentSelect = document.getElementById('department');
    if (departmentSelect) {
        departmentSelect.selectedIndex = 0;  // Reset the select to the default "Choose Department"
        departmentSelect.disabled = true;    // Disable the department select
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

    const updateBtn = document.getElementById('updateBtn');
    const submitBtn = document.getElementById('submitBtn');

    if (updateBtn) updateBtn.style.display = 'none';  // Hide the update button
    if (submitBtn) submitBtn.style.display = 'inline-block';  // Show the submit button
});

// Event listener for unlocking forms when any coordinator button is clicked
document.getElementById('coordinatorInfo').addEventListener('click', function(event) {
    // Check if the clicked element is a coordinator button
    if (event.target && event.target.matches('button[data-id]')) {
        unlockAndResetForms();
        showUpdateButton();

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
    document.getElementById('updateBtn').style.display = 'none';
});