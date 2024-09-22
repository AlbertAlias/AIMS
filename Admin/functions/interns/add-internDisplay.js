// Function to show Update button and hide Submit button
function showUpdateButton() {
    const updateBtn = document.getElementById('updateBtn');
    const submitBtn = document.getElementById('submitBtn');

    if (updateBtn) updateBtn.style.display = 'inline-block'; // Show the update button
    if (submitBtn) submitBtn.style.display = 'none';         // Hide the submit button
}

// Function to enable all fields except the locked ones
function unlockAndResetForms() {
    const internsForm = document.getElementById('internsForm');
    const accountInfoForm = document.getElementById('accountInfoForm');

    if (internsForm) {
        internsForm.reset();
        document.querySelectorAll('#internsForm input, #internsForm select').forEach(el => {
            if (!['coordinator_name', 'coordinator_email', 'password', 'account_email'].includes(el.id)) {
                el.disabled = false;
            }
        });
    }

    if (accountInfoForm) {
        accountInfoForm.reset();
        document.querySelectorAll('#accountInfoForm input').forEach(el => {
            if (el.id !== 'account_email' && el.id !== 'password') {
                el.disabled = false;
            }
        });
    }

    const submitBtn = document.getElementById('submitBtn');
    const cancelBtn = document.getElementById('cancelBtn');

    if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.style.display = 'inline-block';
    }

    if (cancelBtn) cancelBtn.style.display = 'inline-block';
}

// Function to disable all fields and reset forms
function disableAndResetForms() {
    const internsForm = document.getElementById('internsForm');
    const accountInfoForm = document.getElementById('accountInfoForm');

    if (internsForm) {
        internsForm.reset();
        // Reset the department select specifically
        const departmentSelect = document.getElementById('department');
        if (departmentSelect) {
            departmentSelect.selectedIndex = 0; // Reset to the first option or set as needed
        }

        document.querySelectorAll('#internsForm input, #internsForm select').forEach(el => {
            el.disabled = true; // Disable all fields
        });
    }

    if (accountInfoForm) {
        accountInfoForm.reset();
        document.querySelectorAll('#accountInfoForm input').forEach(el => {
            el.disabled = true; // Lock the account info fields
        });
    }

    const submitBtn = document.getElementById('submitBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const updateBtn = document.getElementById('updateBtn'); // Get the update button

    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.style.display = 'inline-block'; // Hide the submit button
    }

    if (cancelBtn) {
        cancelBtn.style.display = 'none'; // Hide the cancel button
    }

    if (updateBtn) {
        updateBtn.style.display = 'none'; // Hide the update button
    }
}

// Event listeners for form actions
document.getElementById('addInternsBtn').addEventListener('click', function() {
    console.log('Add Interns button clicked');
    unlockAndResetForms();
    loadDepartments(null, true);

    const updateBtn = document.getElementById('updateBtn');
    const submitBtn = document.getElementById('submitBtn');

    if (updateBtn) updateBtn.style.display = 'none';
    if (submitBtn) submitBtn.style.display = 'inline-block';
});


document.getElementById('internsInfo').addEventListener('click', function(event) {
    if (event.target && event.target.matches('button[data-id]')) {
        const internID = event.target.getAttribute('data-id');
        document.getElementById('internID').value = internID; // Set the intern ID
        console.log('Selected Intern ID:', internID); // Check if ID is correctly set
        unlockAndResetForms();
        showUpdateButton();
        loadInternDetails(internID);
    }
});

document.getElementById('cancelBtn').addEventListener('click', function() {
    disableAndResetForms();
    console.log('Cancel button clicked');
    disableAndResetForms();
    console.log('Forms disabled and reset');
    this.style.display = 'none';
    document.getElementById('updateBtn').style.display = 'none';
});