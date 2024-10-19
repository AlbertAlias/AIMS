document.addEventListener('DOMContentLoaded', function() {
    // Get references to the buttons and the form
    const addAdminsBtn = document.getElementById('addAdminsBtn');
    const cancelBtn = document.getElementById('adminCancelBtn');
    const submitBtn = document.getElementById('adminSubmitBtn');
    const updateBtn = document.getElementById('adminUpdateBtn');
    const adminsInfo = document.getElementById('adminsInfo'); // Get reference to the adminsInfo container
    let selectedAdmin = null; // To keep track of the selected admin

    // Function to unlock inputs and reset their states
    function unlockAndResetForms() {
        const fieldsToUnlock = [
            'admin_last_name', 'admin_first_name', 'admin_middle_name', 'admin_suffix', 'admin_address', 'admin_civil_status', 
            'admin_personal_email', 'admin_employee_number', 'admin_account_email', 'admin_password', 'user_type'
        ];
    
        fieldsToUnlock.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                field.disabled = false; // Enable the field
                if (field.tagName === 'SELECT') {
                    field.selectedIndex = 0; // Reset select to the first option
                } else {
                    field.value = ''; // Reset the field value only for input fields
                }
            }
        });
    
        // Enable the Submit button
        if (submitBtn) {
            submitBtn.disabled = false; // Enable the Submit button
            submitBtn.style.display = 'inline-block'; // Ensure the Submit button is displayed
        }
    
        // Show the Cancel button and ensure the Update button is hidden
        cancelBtn.style.display = 'inline-block'; // Show the cancel button
        updateBtn.style.display = 'none'; // Hide the update button
    }        

    // Function to reset and lock inputs and selects
    function resetAndLockForms() {
        const fieldsToLock = [
            'admin_last_name', 'admin_first_name', 'admin_middle_name', 'admin_suffix', 'admin_address', 'admin_civil_status', 
            'admin_personal_email', 'admin_employee_number', 'admin_account_email', 'admin_password', 'user_type'
        ];
    
        fieldsToLock.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                if (field.tagName === 'SELECT') {
                    field.selectedIndex = 0; // Reset select to the first option
                } else {
                    field.value = ''; // Reset input fields
                }
                field.disabled = true; // Disable the field
            }
        });
    
        // Disable the Submit button
        if (submitBtn) {
            submitBtn.disabled = true; // Disable the Submit button
        }
    
        // Hide the cancel and update buttons
        cancelBtn.style.display = 'none';
        updateBtn.style.display = 'none';
    }    

    // Function to disable and reset unlocked fields upon successful submission
    function disableAndResetForms() {
        const fieldsToReset = [
            'admin_last_name', 'admin_first_name', 'admin_middle_name', 'admin_suffix', 'admin_address', 'admin_civil_status', 
            'admin_personal_email', 'admin_employee_number', 'admin_account_email', 'admin_password', 'user_type'
        ];
    
        // Reset and lock fields
        fieldsToReset.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                if (field.tagName === 'SELECT') {
                    field.selectedIndex = 0; // Reset select to the first option
                } else {
                    field.value = ''; // Reset input fields
                }
                field.disabled = true; // Disable the field
            }
        });
    
        // Disable the submit button
        if (submitBtn) {
            submitBtn.disabled = true; // Disable the Submit button
        }
    
        // Hide the cancel and update buttons
        cancelBtn.style.display = 'none';
        updateBtn.style.display = 'none';
    }

    // Function to validate the form
    window.validateForm = function() {
        const requiredFields = [
            'admin_last_name', 'admin_first_name', 'admin_address', 'admin_civil_status', 'admin_employee_number', 'admin_personal_email'
        ];

        for (let fieldId of requiredFields) {
            const field = document.getElementById(fieldId);
            if (!field || field.value.trim() === '') {
                return false; // If any required field is empty
            }
        }
        return true; // All required fields are filled
    };

    // Function to handle the admin button click
    function handleAdminButtonClick(event) {
        if (event.target && event.target.classList.contains('admin-btn')) {
            selectedAdmin = event.target.dataset.id; // Store selected admin ID
            unlockAndResetForms();
            // Show the update button and hide the submit button
            submitBtn.style.display = 'none'; // Hide the submit button
            updateBtn.style.display = 'inline-block'; // Show the update button
        }
    }

    // Use event delegation to listen for clicks on dynamically created admin buttons
    if (adminsInfo) {
        adminsInfo.addEventListener('click', handleAdminButtonClick);
    } else {
        console.error('adminsInfo element not found');
    }

    if (addAdminsBtn) {
        // Event listener for the Add Admins button
        addAdminsBtn.addEventListener('click', unlockAndResetForms);
    } else {
        console.error('addAdminsBtn element not found');
    }

    if (cancelBtn) {
        // Event listener for the Cancel button
        cancelBtn.addEventListener('click', function() {
            resetAndLockForms(); // Reset and lock all fields
            submitBtn.disabled = true; // Keep the Submit button disabled
            submitBtn.style.display = 'inline-block'; // Show the Submit button
        });
    } else {
        console.error('cancelBtn element not found');
    }

    // Expose the disableAndResetForms function to be called from create-admins.js
    window.disableAndResetForms = disableAndResetForms;
});