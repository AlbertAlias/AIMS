let isUpdating = false;

if (document.getElementById('coordinatorForm')) {
    function showUpdateButton() {
        const coorUpdateBtn = document.getElementById('coorUpdateBtn');
        const coorDeleteBtn = document.getElementById('coorDeleteBtn');
        const coorSubmitBtn = document.getElementById('coorSubmitBtn');

        if (coorUpdateBtn) {
            coorUpdateBtn.style.display = 'inline-block';
            coorUpdateBtn.disabled = false;
        }

        if (coorDeleteBtn) {
            coorDeleteBtn.style.display = 'inline-block';
            coorDeleteBtn.disabled = false;
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

        coorUpdateBtn.disabled = !allFilled;
        coorDeleteBtn.disabled = !allFilled;
    }

    function unlockAndResetForms() {
        const coordinatorForm = document.getElementById('coordinatorForm');
        const coor_accountForm = document.getElementById('coor_accountForm');
    
        if (coordinatorForm) {
            coordinatorForm.reset();
            document.querySelectorAll('#coordinatorForm input, #coordinatorForm select').forEach(el => {
                el.disabled = false;
                $(el).on('input change', toggleUpdateButton);
            });
        }
    
        if (coor_accountForm) {
            coor_accountForm.reset();
            document.querySelectorAll('#coor_accountForm input').forEach(el => el.disabled = false);
        }
    
        const coorDepartmentSelect = document.getElementById('coor_department');
        if (coorDepartmentSelect) {
            coorDepartmentSelect.disabled = false;
            coorDepartmentSelect.selectedIndex = 0;
        }
    
        const coorSubmitBtn = document.getElementById('coorSubmitBtn');
        const coorCancelBtn = document.getElementById('coorCancelBtn');
        const coorUpdateBtn = document.getElementById('coorUpdateBtn');
        const coorDeleteBtn = document.getElementById('coorDeleteBtn');
    
        if (coorSubmitBtn) {
            coorSubmitBtn.disabled = false; // Allow submission
            coorSubmitBtn.style.display = 'inline-block';
        }
    
        if (coorCancelBtn) {
            coorCancelBtn.style.display = 'inline-block';
            coorCancelBtn.disabled = false;
        }
    
        toggleUpdateButton();
    }    

    function resetAndLockForms() {
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
    
        const coorDepartmentSelect = document.getElementById('coor_department');
        if (coorDepartmentSelect) {
            coorDepartmentSelect.selectedIndex = 0;
            coorDepartmentSelect.disabled = true;
        }
    
        const coorSubmitBtn = document.getElementById('coorSubmitBtn');
        const coorCancelBtn = document.getElementById('coorCancelBtn');
        const coorUpdateBtn = document.getElementById('coorUpdateBtn');
        const coorDeleteBtn = document.getElementById('coorDeleteBtn');
    
        if (coorUpdateBtn) {
            coorUpdateBtn.style.display = 'none';
        }
    
        if (coorDeleteBtn) {
            coorDeleteBtn.style.display = 'none';
        }
    
        if (coorSubmitBtn) {
            coorSubmitBtn.disabled = true; // Disable by default
            coorSubmitBtn.style.display = 'inline-block';
        }
    
        if (coorCancelBtn) {
            coorCancelBtn.style.display = 'none';
        }
    }            

    document.addEventListener('DOMContentLoaded', function() {
        resetAndLockForms();
    });

    document.getElementById('addCoordinatorsBtn').addEventListener('click', function() {
        unlockAndResetForms();
        loadDepartments();

        isUpdating = false;
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
            isUpdating = true;
        }
    });

    const coorCancelBtn = document.getElementById('coorCancelBtn');
    if (coorCancelBtn) {
        coorCancelBtn.addEventListener('click', function() {
            resetAndLockForms();
        });
    }

    document.querySelectorAll('#coordinatorForm input, #coordinatorForm select').forEach(el => {
        $(el).on('input change', toggleUpdateButton);
    });
}