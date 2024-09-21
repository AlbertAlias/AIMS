// Ensure the script runs only on the Interns page
if (document.getElementById('internsForm')) {
    // Function to show Update button and hide Submit button
    function showUpdateButton() {
        const updateBtn = document.getElementById('updateBtn');
        const submitBtn = document.getElementById('submitBtn');

        if (updateBtn) updateBtn.style.display = 'inline-block';  // Show the update button
        if (submitBtn) submitBtn.style.display = 'none';          // Hide the submit button
    }

    // Function to enable both Interns and account information forms
    function unlockAndResetForms() {
        const internsForm = document.getElementById('internsForm');
        const accountInfoForm = document.getElementById('accountInfoForm');

        if (internsForm) {
            internsForm.reset();
            document.querySelectorAll('#internsForm input, #internsForm select').forEach(el => el.disabled = false);
        }

        if (accountInfoForm) {
            accountInfoForm.reset();
            document.querySelectorAll('#accountInfoForm input').forEach(el => el.disabled = false);
        }

        const submitBtn = document.getElementById('submitBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.style.display = 'inline-block';
        }

        if (cancelBtn) cancelBtn.style.display = 'inline-block';
    }

    function disableAndResetForms() {
        const internsForm = document.getElementById('internsForm');
        const accountInfoForm = document.getElementById('accountInfoForm');

        if (internsForm) {
            internsForm.reset();
            document.querySelectorAll('#internsForm input, #internsForm select').forEach(el => el.disabled = true);
        }

        if (accountInfoForm) {
            accountInfoForm.reset();
            document.querySelectorAll('#accountInfoForm input').forEach(el => el.disabled = true);
        }

        const departmentSelect = document.getElementById('department');
        if (departmentSelect) {
            departmentSelect.selectedIndex = 0;  // Reset the select to the default "Choose Department"
            departmentSelect.disabled = true;    // Disable the department select
        }

        const submitBtn = document.getElementById('submitBtn');
        const cancelBtn = document.getElementById('cancelBtn');

        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.style.display = 'inline-block';
        }

        if (cancelBtn) cancelBtn.style.display = 'none';
    }

    document.getElementById('addInternsBtn').addEventListener('click', function() {
        unlockAndResetForms();
        loadDepartments(null, true);

        const updateBtn = document.getElementById('updateBtn');
        const submitBtn = document.getElementById('submitBtn');

        if (updateBtn) updateBtn.style.display = 'none';  // Hide the update button
        if (submitBtn) submitBtn.style.display = 'inline-block';  // Show the submit button
    });

    document.getElementById('internsInfo').addEventListener('click', function(event) {
        if (event.target && event.target.matches('button[data-id]')) {
            unlockAndResetForms();
            showUpdateButton();

            const internsId = event.target.getAttribute('data-id');
            console.log('Selected Interns ID:', internsId);
        }
    });

    document.getElementById('cancelBtn').addEventListener('click', function() {
        disableAndResetForms();  // Lock forms when "Cancel" is clicked
        this.style.display = 'none';
        document.getElementById('updateBtn').style.display = 'none';
    });
}
