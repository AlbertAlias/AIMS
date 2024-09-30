if (document.getElementById('coordinatorForm')) {
    function showUpdateButton() {
        const coorUpdateBtn = document.getElementById('coorUpdateBtn');
        const coorSubmitBtn = document.getElementById('coorSubmitBtn');

        if (coorUpdateBtn) {
            coorUpdateBtn.style.display = 'inline-block';
            coorUpdateBtn.disabled = false;
        }
        if (coorSubmitBtn) coorSubmitBtn.style.display = 'none';
    }

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
    
        const coorDepartmentSelect = document.getElementById('coor_department');
        if (coorDepartmentSelect) {
            coorDepartmentSelect.selectedIndex = 0;
            coorDepartmentSelect.disabled = true;
        }
    
        const coorSubmitBtn = document.getElementById('coorSubmitBtn');
        const coorCancelBtn = document.getElementById('coorCancelBtn');
        const coorUpdateBtn = document.getElementById('coorUpdateBtn');
        const coorDeleteBtn = document.getElementById('coorDeleteBtn');
    
        // Hide the update and delete buttons, show and disable the submit button
        if (coorUpdateBtn) {
            coorUpdateBtn.style.display = 'none';
        }
    
        if (coorDeleteBtn) {
            coorDeleteBtn.style.display = 'none';
        }
    
        if (coorSubmitBtn) {
            coorSubmitBtn.disabled = true; // Keep the submit button disabled
            coorSubmitBtn.style.display = 'inline-block'; // Show the submit button
        }
    
        if (coorCancelBtn) {
            coorCancelBtn.style.display = 'none'; // Hide the cancel button
        }
    }       

    document.getElementById('addCoordinatorsBtn').addEventListener('click', function() {
        unlockAndResetForms();
        loadDepartments();

        const coorUpdateBtn = document.getElementById('coorUpdateBtn');
        const coorSubmitBtn = document.getElementById('coorSubmitBtn');
        const coorDeleteBtn = document.getElementById('coorDeleteBtn');

        if (coorUpdateBtn) coorUpdateBtn.style.display = 'none';
        if (coorSubmitBtn) coorSubmitBtn.style.display = 'inline-block';
        if (coorDeleteBtn) coorDeleteBtn.style.display = 'none';
    });

    document.getElementById('coordinatorInfo').addEventListener('click', function(event) {
        if (event.target && event.target.matches('button[data-id]')) {
            unlockAndResetForms();
            showUpdateButton();
            
            const coorDeleteBtn = document.getElementById('coorDeleteBtn');
            if (coorDeleteBtn) {
                console.log('Displaying delete button');
                coorDeleteBtn.style.display = 'inline-block';
            }
        
            const coorID = event.target.getAttribute('data-id');
            const coorIDElement = document.getElementById('coorID');
            if (coorIDElement) {
                coorIDElement.value = coorID; // Set value only if coorIDElement exists
            }
            console.log('Selected Coordinator ID:', coorID);
            loadCoorDetails(coorID);
        }
    });       

    document.getElementById('coorCancelBtn').addEventListener('click', function() {
        disableAndResetForms();
        this.style.display = 'none';
        document.getElementById('coorUpdateBtn').style.display = 'none';
        document.getElementById('coorDeleteBtn').style.display = 'none';
    });

    document.getElementById('coorUpdateBtn').addEventListener('click', function() {
        resetAndLockForms();
        console.log('Coordinator updated and forms locked.');
    });
}