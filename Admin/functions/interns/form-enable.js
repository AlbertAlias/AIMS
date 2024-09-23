// Function to show Update button and hide Submit button
function showUpdateButton() {
    const internUpdateBtn = document.getElementById('internUpdateBtn');
    const internSubmitBtn = document.getElementById('internSubmitBtn');

    if (internUpdateBtn) internUpdateBtn.style.display = 'inline-block'; // Show the update button
    if (internSubmitBtn) internSubmitBtn.style.display = 'none';         // Hide the submit button
}

// Function to enable all fields except the locked ones
function unlockAndResetForms() {
    const internsForm = document.getElementById('internsForm');
    const intern_accountForm = document.getElementById('intern_accountForm');

    if (internsForm) {
        internsForm.reset();
        document.querySelectorAll('#internsForm input, #internsForm select').forEach(el => {
            if (!['coordinator_name', 'coordinator_email', 'intern_password', 'intern_account_email'].includes(el.id)) {
                el.disabled = false;
            }
        });
    }

    if (intern_accountForm) {
        intern_accountForm.reset();
        document.querySelectorAll('#intern_accountForm input').forEach(el => {
            if (el.id !== 'intern_account_email' && el.id !== 'intern_password') {
                el.disabled = false;
            }
        });
    }

    const internSubmitBtn = document.getElementById('internSubmitBtn');
    const internCancelBtn = document.getElementById('internCancelBtn');

    if (internSubmitBtn) {
        internSubmitBtn.disabled = false;
        internSubmitBtn.style.display = 'inline-block';
    }

    if (internCancelBtn) internCancelBtn.style.display = 'inline-block';
}

// Function to disable all fields and reset forms
function disableAndResetForms() {
    const internsForm = document.getElementById('internsForm');
    const intern_accountForm = document.getElementById('intern_accountForm');

    if (internsForm) {
        internsForm.reset();
        // Reset the department select specifically
        const departmentSelect = document.getElementById('intern_department');
        if (departmentSelect) {
            departmentSelect.selectedIndex = 0; // Reset to the first option or set as needed
        }

        document.querySelectorAll('#internsForm input, #internsForm select').forEach(el => {
            el.disabled = true; // Disable all fields
        });
    }

    if (intern_accountForm) {
        intern_accountForm.reset();
        document.querySelectorAll('#intern_accountForm input').forEach(el => {
            el.disabled = true; // Lock the account info fields
        });
    }

    const internSubmitBtn = document.getElementById('internSubmitBtn');
    const internCancelBtn = document.getElementById('internCancelBtn');
    const internUpdateBtn = document.getElementById('internUpdateBtn'); // Get the update button

    if (internSubmitBtn) {
        internSubmitBtn.disabled = true;
        internSubmitBtn.style.display = 'inline-block'; // Hide the submit button
    }

    if (internCancelBtn) {
        internCancelBtn.style.display = 'none'; // Hide the cancel button
    }

    if (internUpdateBtn) {
        internUpdateBtn.style.display = 'none'; // Hide the update button
    }
}

// Event listeners for form actions
document.getElementById('addInternsBtn').addEventListener('click', function() {
    console.log('Add Interns button clicked');
    unlockAndResetForms();
    loadDepartments(null, true);

    const internUpdateBtn = document.getElementById('internUpdateBtn');
    const internSubmitBtn = document.getElementById('internSubmitBtn');

    if (internUpdateBtn) internUpdateBtn.style.display = 'none';
    if (internSubmitBtn) internSubmitBtn.style.display = 'inline-block';
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

document.getElementById('internCancelBtn').addEventListener('click', function() {
    disableAndResetForms();
    console.log('Cancel button clicked');
    disableAndResetForms();
    console.log('Forms disabled and reset');
    this.style.display = 'none';
    document.getElementById('internUpdateBtn').style.display = 'none';
});