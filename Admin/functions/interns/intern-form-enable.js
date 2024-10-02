document.addEventListener('DOMContentLoaded', function() {
    // Get references to the buttons and the form
    const addInternsBtn = document.getElementById('addInternsBtn');
    const internsForm = document.getElementById('internsForm');
    const internCancelBtn = document.getElementById('internCancelBtn');
    const submitBtn = document.getElementById('internSubmitBtn');

    // Function to unlock inputs and reset their states
    function unlockAndResetForms() {
        const fieldsToUnlock = [
            'intern_last_name', 'intern_first_name', 'intern_middle_name',
            'intern_suffix', 'intern_gender', 'intern_address',
            'intern_birthdate', 'intern_civil_status', 'intern_personal_email',
            'intern_contact_number', 'studentID', 'intern_department',
            'hours_needed', 'internship_status'
        ];

        fieldsToUnlock.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                field.disabled = false; // Enable the field
                // Only reset input fields, not select fields
                if (field.tagName !== 'SELECT') {
                    field.value = ''; // Reset the field value only for input fields
                }
            }
        });

        // Enable the Submit button
        if (submitBtn) {
            submitBtn.disabled = false; // Enable the Submit button
        }

        // Show the cancel and update buttons
        internCancelBtn.style.display = 'inline-block';
        document.getElementById('internUpdateBtn').style.display = 'none';
    }

    // Function to reset and lock inputs and selects
    function resetAndLockForms() {
        const fieldsToLock = [
            'intern_last_name', 'intern_first_name', 'intern_middle_name',
            'intern_suffix', 'intern_gender', 'intern_address',
            'intern_birthdate', 'intern_civil_status', 'intern_personal_email',
            'intern_contact_number', 'studentID', 'intern_department',
            'coordinator_name', 'coordinator_email',
            'hours_needed', 'internship_status'
        ];

        // Reset unlocked fields and lock all fields
        fieldsToLock.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                // Reset the field value if it's an input field
                if (field.tagName !== 'SELECT') {
                    field.value = ''; // Reset the field value only for input fields
                }
                field.disabled = true; // Disable the field
            }
        });

        // Disable the Submit button
        if (submitBtn) {
            submitBtn.disabled = true; // Disable the Submit button
        }

        // Hide the cancel and update buttons
        internCancelBtn.style.display = 'none';
        document.getElementById('internUpdateBtn').style.display = 'none';
    }

    // Function to disable and reset unlocked fields upon successful submission
    function disableAndResetForms() {
        const fieldsToReset = [
            'intern_last_name', 'intern_first_name', 'intern_middle_name',
            'intern_suffix', 'intern_gender', 'intern_address',
            'intern_birthdate', 'intern_civil_status', 'intern_personal_email',
            'intern_contact_number', 'studentID', 'intern_department',
            'hours_needed', 'internship_status', 'coordinator_name', 'coordinator_email'
        ];
    
        // Reset unlocked fields and lock them
        fieldsToReset.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                // Reset the field value based on its type
                if (field.tagName === 'SELECT') {
                    field.selectedIndex = 0; // Reset select to the first option (assumes first is disabled)
                } else {
                    field.value = ''; // Reset the field value for input fields
                }
                field.disabled = true; // Disable the field
            }
        });
    
        // Reset and lock account fields
        const accountFields = [
            'intern_account_email', 'intern_password'
        ];
    
        accountFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                field.value = ''; // Reset the field value
                field.disabled = true; // Disable the field
            }
        });
    
        // Disable the Submit button
        if (submitBtn) {
            submitBtn.disabled = true; // Disable the Submit button
        }
    
        // Hide the cancel and update buttons
        internCancelBtn.style.display = 'none';
        document.getElementById('internUpdateBtn').style.display = 'none';
    }

    // Event listener for the Add Interns button
    addInternsBtn.addEventListener('click', unlockAndResetForms);

    // Event listener for the Cancel button
    internCancelBtn.addEventListener('click', resetAndLockForms);

    // Expose the disableAndResetForms function to be called from create-interns.js
    window.disableAndResetForms = disableAndResetForms;
});