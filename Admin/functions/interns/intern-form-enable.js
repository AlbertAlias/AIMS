document.addEventListener('DOMContentLoaded', function() {
    // Get references to the buttons and the form
    const addInternsBtn = document.getElementById('addInternsBtn');
    const internCancelBtn = document.getElementById('internCancelBtn');
    const submitBtn = document.getElementById('internSubmitBtn');
    const updateBtn = document.getElementById('internUpdateBtn');
    const internsInfo = document.getElementById('internsInfo'); // Get reference to the internsInfo container
    let selectedIntern = null; // To keep track of the selected intern

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
                // Reset the field value only for input fields
                if (field.tagName !== 'SELECT') {
                    field.value = ''; // Reset the field value only for input fields
                }
            }
        });

        // Reset account fields
        const accountFields = [
            'intern_account_email', 'intern_password'
        ];

        accountFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                field.value = ''; // Reset the field value
                field.disabled = true; // Disable the field for input
            }
        });

        // Enable the Submit button
        if (submitBtn) {
            submitBtn.disabled = false; // Enable the Submit button
            submitBtn.style.display = 'inline-block'; // Ensure the Submit button is displayed
        }

        // Show the Cancel button and ensure the Update button is hidden
        internCancelBtn.style.display = 'inline-block'; // Show the cancel button
        updateBtn.style.display = 'none'; // Hide the update button
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
        updateBtn.style.display = 'none';
    }

    // Function to disable and reset unlocked fields upon successful submission
    function disableAndResetForms() {
        const fieldsToReset = [
            'intern_last_name', 'intern_first_name', 'intern_middle_name',
            'intern_suffix', 'intern_gender', 'intern_address',
            'intern_birthdate', 'intern_civil_status', 'intern_personal_email',
            'intern_contact_number', 'studentID', 'intern_department',
            'coordinator_name', 'coordinator_email', 'hours_needed', 'internship_status'
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
        updateBtn.style.display = 'none';
    }

    function unlockForms() {
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
            }
        });

        // Enable the Submit button
        if (submitBtn) {
            submitBtn.disabled = false; // Enable the Submit button
        }

        // Show the cancel button and hide the update button
        internCancelBtn.style.display = 'inline-block';
        updateBtn.style.display = 'none';
    }

    // Function to validate the form
    window.validateForm = function() { // Changed here
        const requiredFields = [
            'intern_last_name', 
            'intern_first_name', 
            'studentID', 
            'intern_department', 
            'hours_needed', 
            'internship_status',
            'intern_gender',           
            'intern_birthdate',        
            'intern_civil_status',     
            'intern_personal_email',   
            'intern_contact_number',    
            'coordinator_name',        
            'coordinator_email'        
        ];

        for (let fieldId of requiredFields) {
            const field = document.getElementById(fieldId);
            if (!field || field.value.trim() === '') {
                return false; // If any required field is empty
            }
        }
        return true; // All required fields are filled
    };    

    // Function to handle the intern button click
    function handleInternButtonClick(event) {
        if (event.target && event.target.classList.contains('intern-btn')) {
            selectedIntern = event.target.dataset.id; // Store selected intern ID
            unlockForms();
            // Show the update button and hide the submit button
            submitBtn.style.display = 'none'; // Hide the submit button
            updateBtn.style.display = 'inline-block'; // Show the update button
        }
    }

    // Use event delegation to listen for clicks on dynamically created intern buttons
    if (internsInfo) {
        internsInfo.addEventListener('click', handleInternButtonClick);
    } else {
        console.error('internsInfo element not found');
    }

    if (addInternsBtn) {
        // Event listener for the Add Interns button
        addInternsBtn.addEventListener('click', unlockAndResetForms);
    } else {
        console.error('addInternsBtn element not found');
    }

    if (internCancelBtn) {
        // Event listener for the Cancel button
        internCancelBtn.addEventListener('click', function() {
            resetAndLockForms();
            // Show the Submit button but keep it disabled
            submitBtn.disabled = true; // Keep the Submit button disabled
            submitBtn.style.display = 'inline-block'; // Show the Submit button
        });
    } else {
        console.error('internCancelBtn element not found');
    }

    // Expose the disableAndResetForms function to be called from create-interns.js
    window.disableAndResetForms = disableAndResetForms;
});