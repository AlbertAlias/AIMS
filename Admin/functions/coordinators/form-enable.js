// Ensure the script runs only on the Coordinators page
if (document.getElementById('coordinatorForm')) {
    // Function to show Update button and hide Submit button
    function showUpdateButton() {
        const coorUpdateBtn = document.getElementById('coorUpdateBtn');
        const coorSubmitBtn = document.getElementById('coorSubmitBtn');

        if (coorUpdateBtn) coorUpdateBtn.style.display = 'inline-block';  // Show the update button
        if (coorSubmitBtn) coorSubmitBtn.style.display = 'none';          // Hide the submit button
    }

    // Function to enable both coordinator and account information forms
    function unlockAndResetForms() {
        const coordinatorForm = document.getElementById('coordinatorForm');
        const coor_accountForm = document.getElementById('coor_accountForm');

        if (coordinatorForm) {
            coordinatorForm.reset();
            document.querySelectorAll('#coordinatorForm input, #coordinatorForm select').forEach(el => el.disabled = false);
        }

        if (coor_accountForm) {
            coor_accountForm.reset();
            document.querySelectorAll('#coor_accountForm input').forEach(el => el.disabled = false);
        }

        const coorSubmitBtn = document.getElementById('coorSubmitBtn');
        const coorCancelBtn = document.getElementById('coorCancelBtn');
        
        if (coorSubmitBtn) {
            coorSubmitBtn.disabled = false;
            coorSubmitBtn.style.display = 'inline-block';
        }

        if (coorCancelBtn) coorCancelBtn.style.display = 'inline-block';
    }

    function disableAndResetForms() {
        const coordinatorForm = document.getElementById('coordinatorForm');
        const coor_accountForm = document.getElementById('coor_accountForm');

        if (coordinatorForm) {
            coordinatorForm.reset();
            document.querySelectorAll('#coordinatorForm input, #coordinatorForm select').forEach(el => el.disabled = true);
        }

        if (coor_accountForm) {
            coor_accountForm.reset();
            document.querySelectorAll('#coor_accountForm input').forEach(el => el.disabled = true);
        }

        const departmentSelect = document.getElementById('department');
        if (departmentSelect) {
            departmentSelect.selectedIndex = 0;  // Reset the select to the default "Choose Department"
            departmentSelect.disabled = true;    // Disable the department select
        }

        const coorSubmitBtn = document.getElementById('coorSubmitBtn');
        const coorCancelBtn = document.getElementById('coorCancelBtn');

        if (coorSubmitBtn) {
            coorSubmitBtn.disabled = true;
            coorSubmitBtn.style.display = 'inline-block';
        }

        if (coorCancelBtn) coorCancelBtn.style.display = 'none';
    }

    document.getElementById('addCoordinatorsBtn').addEventListener('click', function() {
        unlockAndResetForms();
        loadDepartments(null, true);

        const coorUpdateBtn = document.getElementById('coorUpdateBtn');
        const coorSubmitBtn = document.getElementById('coorSubmitBtn');

        if (coorUpdateBtn) coorUpdateBtn.style.display = 'none';  // Hide the update button
        if (coorSubmitBtn) coorSubmitBtn.style.display = 'inline-block';  // Show the submit button
    });

    document.getElementById('coordinatorInfo').addEventListener('click', function(event) {
        if (event.target && event.target.matches('button[data-id]')) {
            unlockAndResetForms();
            showUpdateButton();

            const coordinatorId = event.target.getAttribute('data-id');
            console.log('Selected Coordinator ID:', coordinatorId);
        }
    });

    document.getElementById('coorCancelBtn').addEventListener('click', function() {
        disableAndResetForms();  // Lock forms when "Cancel" is clicked
        this.style.display = 'none';
        document.getElementById('coorUpdateBtn').style.display = 'none';
    });
}
