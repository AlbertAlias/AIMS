if (document.getElementById('adminsForm')) {
    function showUpdateButton() {
        const adminUpdateBtn = document.getElementById('adminUpdateBtn');
        const adminSubmitBtn = document.getElementById('adminSubmitBtn');

        if (adminUpdateBtn) {
            adminUpdateBtn.style.display = 'inline-block';
            adminUpdateBtn.disabled = false;
        }
        if (adminSubmitBtn) adminSubmitBtn.style.display = 'none';
    }

    function unlockAndResetForms() {
        const adminsForm = document.getElementById('adminsForm');
        const admin_accountForm = document.getElementById('admin_accountForm');

        if (adminsForm) {
            adminsForm.reset();
            document.querySelectorAll('#adminsForm input, #adminsForm select').forEach(el => el.disabled = false);
        }

        if (admin_accountForm) {
            admin_accountForm.reset();
            document.querySelectorAll('#admin_accountForm input, #admin_accountForm select').forEach(el => el.disabled = false);
        }

        const adminSubmitBtn = document.getElementById('adminSubmitBtn');
        const adminCancelBtn = document.getElementById('adminCancelBtn');
        
        if (adminSubmitBtn) {
            adminSubmitBtn.disabled = false;
            adminSubmitBtn.style.display = 'inline-block';
        }

        if (adminCancelBtn) adminCancelBtn.style.display = 'inline-block';
    }

    function disableAndResetForms() {
        const adminsForm = document.getElementById('adminsForm');
        const admin_accountForm = document.getElementById('admin_accountForm');
    
        if (adminsForm) {
            adminsForm.reset();
            document.querySelectorAll('#adminsForm input, #adminsForm select').forEach(el => el.disabled = true);
        }
    
        if (admin_accountForm) {
            admin_accountForm.reset();
            document.querySelectorAll('#admin_accountForm input, #admin_accountForm select').forEach(el => el.disabled = true);
        }
    
        const adminDepartmentSelect = document.getElementById('admin_department');
        if (adminDepartmentSelect) {
            adminDepartmentSelect.selectedIndex = 0;
            adminDepartmentSelect.disabled = true;
        }
    
        const adminSubmitBtn = document.getElementById('adminSubmitBtn');
        const adminCancelBtn = document.getElementById('adminCancelBtn');
    
        if (adminSubmitBtn) {
            adminSubmitBtn.disabled = true;
            adminSubmitBtn.style.display = 'inline-block';
        }
    
        if (adminCancelBtn) adminCancelBtn.style.display = 'none';
    }    

    document.getElementById('addAdminsBtn').addEventListener('click', function() {
        unlockAndResetForms();
        loadDepartments(null, true);

        const adminUpdateBtn = document.getElementById('adminUpdateBtn');
        const adminSubmitBtn = document.getElementById('adminSubmitBtn');
        const adminDeleteBtn = document.getElementById('adminDeleteBtn');

        if (adminUpdateBtn) adminUpdateBtn.style.display = 'none';
        if (adminSubmitBtn) adminSubmitBtn.style.display = 'inline-block';
        if (adminDeleteBtn) adminDeleteBtn.style.display = 'none';
    });

    document.getElementById('adminsInfo').addEventListener('click', function(event) {
        if (event.target && event.target.matches('button[data-id]')) {
            unlockAndResetForms();
            showUpdateButton();
            
            const adminDeleteBtn = document.getElementById('adminDeleteBtn');
            if (adminDeleteBtn) {
                console.log('Displaying delete button');
                adminDeleteBtn.style.display = 'inline-block';
            }
        
            const adminID = event.target.getAttribute('data-id');
            const adminIDElement = document.getElementById('adminID');
            if (adminIDElement) {
                adminIDElement.value = adminID; // Set value only if adminIDElement exists
            }
            console.log('Selected Admin ID:', adminID);
            loadAdminDetails(adminID);
        }
    });       

    document.getElementById('adminCancelBtn').addEventListener('click', function() {
        disableAndResetForms();
        this.style.display = 'none';
        document.getElementById('adminUpdateBtn').style.display = 'none';
        document.getElementById('adminDeleteBtn').style.display = 'none';
    });
}