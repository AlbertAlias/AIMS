// Function to show Update button and hide Submit button
function showUpdateButton() {
    const internUpdateBtn = document.getElementById('internUpdateBtn');
    const internSubmitBtn = document.getElementById('internSubmitBtn');

    if (internUpdateBtn) internUpdateBtn.style.display = 'inline-block'; // Show the update button
    if (internSubmitBtn) internSubmitBtn.style.display = 'none';         // Hide the submit button
}

// Function to enable all fields in both forms
function unlockAndResetForms() {
    const adminsForm = document.getElementById('adminsForm');
    const admin_accountForm = document.getElementById('admin_accountForm');

    if (adminsForm) {
        adminsForm.reset();
        document.querySelectorAll('#adminsForm input, #adminsForm select').forEach(el => {
            el.disabled = false; // Enable all fields
        });
    }

    if (admin_accountForm) {
        admin_accountForm.reset();
        document.querySelectorAll('#admin_accountForm input, #admin_accountForm select').forEach(el => {
            el.disabled = false; // Enable all account info fields
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
    const adminsForm = document.getElementById('adminsForm');
    const admin_accountForm = document.getElementById('admin_accountForm');

    if (adminsForm) {
        adminsForm.reset();
        document.querySelectorAll('#adminsForm input, #adminsForm select').forEach(el => {
            el.disabled = true; // Disable all fields
        });
    }

    if (admin_accountForm) {
        admin_accountForm.reset();
        document.querySelectorAll('#admin_accountForm input, #admin_accountForm select').forEach(el => {
            el.disabled = true; // Lock all account info fields
        });
    }

    const internSubmitBtn = document.getElementById('internSubmitBtn');
    const internCancelBtn = document.getElementById('internCancelBtn');
    const internUpdateBtn = document.getElementById('internUpdateBtn');

    if (internSubmitBtn) {
        internSubmitBtn.disabled = true;
        internSubmitBtn.style.display = 'inline-block'; 
    }

    if (internCancelBtn) {
        internCancelBtn.style.display = 'none'; // Hide the cancel button
    }

    if (internUpdateBtn) {
        internUpdateBtn.style.display = 'none'; // Hide the update button
    }
}

// Event listeners for form actions
document.getElementById('addAdminsBtn').addEventListener('click', function() {
    console.log('Add Admins button clicked');
    unlockAndResetForms();

    const internUpdateBtn = document.getElementById('internUpdateBtn');
    const internSubmitBtn = document.getElementById('internSubmitBtn');

    if (internUpdateBtn) internUpdateBtn.style.display = 'none';
    if (internSubmitBtn) internSubmitBtn.style.display = 'inline-block';
});

document.getElementById('adminsInfo').addEventListener('click', function(event) {
    if (event.target && event.target.matches('button[data-id]')) {
        const adminID = event.target.getAttribute('data-id');
        document.getElementById('adminID').value = adminID; // Set the admin ID
        console.log('Selected Admin ID:', adminID); // Check if ID is correctly set
        unlockAndResetForms();
        showUpdateButton();
        loadAdminDetails(adminID); // Function to load the admin details
    }
});

document.getElementById('internCancelBtn').addEventListener('click', function() {
    disableAndResetForms();
    console.log('Cancel button clicked');
    this.style.display = 'none';
    document.getElementById('internUpdateBtn').style.display = 'none';
});