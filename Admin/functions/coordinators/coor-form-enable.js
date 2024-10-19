let isUpdating = false;

if (document.getElementById('coordinatorForm')) {
    function showUpdateButton() {
        const updateBtn = document.getElementById('coorUpdateBtn');
        const deleteBtn = document.getElementById('coorDeleteBtn');
        const submitBtn = document.getElementById('coorSubmitBtn');
        const cancelBtn = document.getElementById('coorCancelBtn');

        if (updateBtn) {
            updateBtn.style.display = 'inline-block';
            updateBtn.disabled = false;
        }

        if (deleteBtn) {
            deleteBtn.style.display = 'inline-block';
            deleteBtn.disabled = false;
        }

        if (submitBtn) submitBtn.style.display = 'none';
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
        
        const updateBtn = document.getElementById('coorUpdateBtn');
        const deleteBtn = document.getElementById('coorDeleteBtn');
        let allFilled = requiredFields.every(selector => $(selector).val().trim() !== '');

        updateBtn.disabled = !allFilled;
        deleteBtn.disabled = !allFilled;
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
    
        const submitBtn = document.getElementById('coorSubmitBtn');
        const cancelBtn = document.getElementById('coorCancelBtn');
        const updateBtn = document.getElementById('coorUpdateBtn');
        const deleteBtn = document.getElementById('coorDeleteBtn');
    
        if (submitBtn) {
            submitBtn.disabled = false; // Allow submission
            submitBtn.style.display = 'inline-block';
        }
    
        if (cancelBtn) {
            cancelBtn.style.display = 'inline-block';
            cancelBtn.disabled = false;
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
    
        const submitBtn = document.getElementById('coorSubmitBtn');
        const cancelBtn = document.getElementById('coorCancelBtn');
        const updateBtn = document.getElementById('coorUpdateBtn');
        const deleteBtn = document.getElementById('coorDeleteBtn');
    
        if (updateBtn) {
            updateBtn.style.display = 'none';
        }
    
        if (deleteBtn) {
            deleteBtn.style.display = 'none';
        }
    
        if (submitBtn) {
            submitBtn.disabled = true; // Disable by default
            submitBtn.style.display = 'inline-block';
        }
    
        if (cancelBtn) {
            cancelBtn.style.display = 'none';
        }
    }            

    document.addEventListener('DOMContentLoaded', function() {
        resetAndLockForms();
    });

    document.getElementById('addCoordinatorsBtn').addEventListener('click', function() {
        unlockAndResetForms();
        loadDepartments();

        isUpdating = false;
        const updateBtn = document.getElementById('coorUpdateBtn');
        const submitBtn = document.getElementById('coorSubmitBtn');
        const deleteBtn = document.getElementById('coorDeleteBtn');

        if (updateBtn) updateBtn.style.display = 'none';
        if (submitBtn) submitBtn.style.display = 'inline-block';
        if (deleteBtn) deleteBtn.style.display = 'none';
    });

    document.getElementById('coordinatorInfo').addEventListener('click', function(event) {
        if (event.target && event.target.matches('button[data-id]')) {
            unlockAndResetForms();
            showUpdateButton();
            isUpdating = true;
        }
    });

    const cancelBtn = document.getElementById('coorCancelBtn');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
            resetAndLockForms();
        });
    }

    document.querySelectorAll('#coordinatorForm input, #coordinatorForm select').forEach(el => {
        $(el).on('input change', toggleUpdateButton);
    });
}