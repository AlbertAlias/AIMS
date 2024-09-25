// Function to show Update button and hide Submit button
function showUpdateButton() {
    const adminUpdateBtn = document.getElementById('adminUpdateBtn');
    const adminSubmitBtn = document.getElementById('adminSubmitBtn');

    if (adminUpdateBtn) adminUpdateBtn.style.display = 'inline-block'; // Show the update button
    if (adminSubmitBtn) adminSubmitBtn.style.display = 'none';         // Hide the submit button
}

// Function to enable all fields except the locked ones
function unlockAndResetForms() {
    const adminsForm = document.getElementById('adminsForm');
    const admin_accountForm = document.getElementById('admin_accountForm');

    if (adminsForm) {
        adminsForm.reset();
        document.querySelectorAll('#adminsForm input, #adminsForm select').forEach(el => {
            // Unlock all fields
            el.disabled = false;
        });
    }

    if (admin_accountForm) {
        admin_accountForm.reset();
        document.querySelectorAll('#admin_accountForm input, #admin_accountForm select').forEach(el => {
            // Unlock all fields
            el.disabled = false;
        });
    }

    const adminSubmitBtn = document.getElementById('adminSubmitBtn');
    const adminCancelBtn = document.getElementById('adminCancelBtn');

    if (adminSubmitBtn) {
        adminSubmitBtn.disabled = false;
        adminSubmitBtn.style.display = 'inline-block';
    }

    if (adminCancelBtn) adminCancelBtn.style.display = 'inline-block';
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
        document.querySelectorAll('#admin_accountForm input').forEach(el => {
            el.disabled = true; // Lock the account info fields
        });
    }

    const adminSubmitBtn = document.getElementById('adminSubmitBtn');
    const adminCancelBtn = document.getElementById('adminCancelBtn');
    const adminUpdateBtn = document.getElementById('adminUpdateBtn'); // Get the update button

    if (adminSubmitBtn) {
        adminSubmitBtn.disabled = true;
        adminSubmitBtn.style.display = 'inline-block'; // Hide the submit button
    }

    if (adminCancelBtn) {
        adminCancelBtn.style.display = 'none'; // Hide the cancel button
    }

    if (adminUpdateBtn) {
        adminUpdateBtn.style.display = 'none'; // Hide the update button
    }
}

// Event listeners for form actions
document.getElementById('addAdminsBtn').addEventListener('click', function() {
    console.log('Add Admin button clicked');
    unlockAndResetForms();
    
    const adminUpdateBtn = document.getElementById('adminUpdateBtn');
    const adminSubmitBtn = document.getElementById('adminSubmitBtn');

    if (adminUpdateBtn) adminUpdateBtn.style.display = 'none';
    if (adminSubmitBtn) adminSubmitBtn.style.display = 'inline-block';
});

document.getElementById('adminsInfo').addEventListener('click', function(event) {
    if (event.target && event.target.matches('button[data-id]')) {
        const adminID = event.target.getAttribute('data-id');
        document.getElementById('adminID').value = adminID; // Set the admin ID
        console.log('Selected Admin ID:', adminID); // Check if ID is correctly set
        unlockAndResetForms();
        showUpdateButton();
        loadAdminDetails(adminID);
    }
});

document.getElementById('adminCancelBtn').addEventListener('click', function() {
    disableAndResetForms();
    console.log('Cancel button clicked');
    this.style.display = 'none';
    document.getElementById('adminUpdateBtn').style.display = 'none';
});