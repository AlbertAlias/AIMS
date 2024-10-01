let isUpdating = false;

if (document.getElementById('coordinatorForm')) {
    function showUpdateButton() {
        const coorUpdateBtn = document.getElementById('coorUpdateBtn');
        const coorDeleteBtn = document.getElementById('coorDeleteBtn');
        const coorSubmitBtn = document.getElementById('coorSubmitBtn');

        if (coorUpdateBtn) {
            coorUpdateBtn.style.display = 'inline-block';
            coorUpdateBtn.disabled = false; // Initially enable the button
        }

        if (coorDeleteBtn) {
            coorDeleteBtn.style.display = 'inline-block';
            coorDeleteBtn.disabled = false; // Initially enable the button
        }

        if (coorSubmitBtn) coorSubmitBtn.style.display = 'none';
    }

    function toggleUpdateButton() {
        if (!isUpdating) return;

        const requiredFields = [
            '#coor_last_name',
            '#coor_first_name',
            '#coor_gender',
            '#coor_address',
            '#coor_birthdate',
            '#coor_civil_status',
            '#coor_personal_email',
            '#coor_contact_number',
            '#coor_account_email',
            '#coor_department'
        ];
        
        const coorUpdateBtn = document.getElementById('coorUpdateBtn');
        const coorDeleteBtn = document.getElementById('coorDeleteBtn');
        let allFilled = requiredFields.every(selector => $(selector).val().trim() !== '');

        coorUpdateBtn.disabled = !allFilled; // Disable button if any required field is empty
        coorDeleteBtn.disabled = !allFilled; // Disable delete button if any required field is empty
    }

    function unlockAndResetForms() {
        const coordinatorForm = document.getElementById('coordinatorForm');
        const coor_accountForm = document.getElementById('coor_accountForm');

        if (coordinatorForm) {
            coordinatorForm.reset();
            document.querySelectorAll('#coordinatorForm input, #coordinatorForm select').forEach(el => {
                el.disabled = false;
                $(el).on('input change', toggleUpdateButton); // Add event listeners
            });
        }

        if (coor_accountForm) {
            coor_accountForm.reset();
            document.querySelectorAll('#coor_accountForm input').forEach(el => el.disabled = false);
        }

        const coorDepartmentSelect = document.getElementById('#coor_department');
        if (coorDepartmentSelect) {
            coorDepartmentSelect.disabled = false; // Unlock the department select
            coorDepartmentSelect.selectedIndex = 0; // Reset to default option
        }

        const coorSubmitBtn = document.getElementById('coorSubmitBtn');
        const coorCancelBtn = document.getElementById('coorCancelBtn');
        const coorUpdateBtn = document.getElementById('coorUpdateBtn');
        const coorDeleteBtn = document.getElementById('coorDeleteBtn');

        if (coorSubmitBtn) {
            coorSubmitBtn.disabled = false;
            coorSubmitBtn.style.display = 'inline-block';
        }

        if (coorCancelBtn) {
            coorCancelBtn.style.display = 'inline-block'; // Show the cancel button
            coorCancelBtn.disabled = false; // Enable the cancel button
        }

        toggleUpdateButton(); // Check button state when unlocking
    }

    function resetAndLockForms() {
        const coordinatorForm = document.getElementById('coordinatorForm');
        const coor_accountForm = document.getElementById('coor_accountForm');

        // Reset and disable the coordinator form
        if (coordinatorForm) {
            coordinatorForm.reset();
            document.querySelectorAll('#coordinatorForm input, #coordinatorForm select').forEach(el => el.disabled = true);
        }

        // Reset and disable the account form
        if (coor_accountForm) {
            coor_accountForm.reset();
            document.querySelectorAll('#coor_accountForm input').forEach(el => el.disabled = true);
        }

        const coorDepartmentSelect = document.getElementById('#coor_department');
        if (coorDepartmentSelect) {
            coorDepartmentSelect.selectedIndex = 0; // Reset to default option
            coorDepartmentSelect.disabled = true; // Lock the department select
        }

        // Handle buttons' visibility and state
        const coorSubmitBtn = document.getElementById('coorSubmitBtn');
        const coorCancelBtn = document.getElementById('coorCancelBtn');
        const coorUpdateBtn = document.getElementById('coorUpdateBtn');
        const coorDeleteBtn = document.getElementById('coorDeleteBtn');

        if (coorUpdateBtn) {
            coorUpdateBtn.style.display = 'none';
        }

        if (coorDeleteBtn) {
            coorDeleteBtn.style.display = 'none'; // Initially hide delete button
        }

        if (coorSubmitBtn) {
            coorSubmitBtn.disabled = true; // Keep the submit button disabled
            coorSubmitBtn.style.display = 'inline-block'; // Show the submit button
        }

        if (coorCancelBtn) {
            coorCancelBtn.style.display = 'none'; // Hide the cancel button after form lock
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        resetAndLockForms();
    });

    document.getElementById('addCoordinatorsBtn').addEventListener('click', function() {
        unlockAndResetForms();
        loadDepartments(); // Assuming this function populates department options

        isUpdating = false;
        const coorUpdateBtn = document.getElementById('coorUpdateBtn');
        const coorSubmitBtn = document.getElementById('coorSubmitBtn');
        const coorDeleteBtn = document.getElementById('coorDeleteBtn');

        if (coorUpdateBtn) coorUpdateBtn.style.display = 'none';
        if (coorSubmitBtn) coorSubmitBtn.style.display = 'inline-block';
        if (coorDeleteBtn) coorDeleteBtn.style.display = 'none'; // Hide delete button on add
    });

    document.getElementById('coordinatorInfo').addEventListener('click', function(event) {
        if (event.target && event.target.matches('button[data-id]')) {
            unlockAndResetForms();
            showUpdateButton();
            isUpdating = true;
        }
    });

    // Event listener for the cancel button
    const coorCancelBtn = document.getElementById('coorCancelBtn');
    if (coorCancelBtn) {
        coorCancelBtn.addEventListener('click', function() {
            resetAndLockForms(); // Lock the form when cancel button is clicked
        });
    }

    // Initialize toggleUpdateButton on form inputs
    document.querySelectorAll('#coordinatorForm input, #coordinatorForm select').forEach(el => {
        $(el).on('input change', toggleUpdateButton);
    });
}