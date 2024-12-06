let isUpdating = false;

if (document.getElementById('coordinatorForm')) {
    function showUpdateButton() {
        const updateBtn = document.getElementById('coorUpdateBtn');
        const deleteBtn = document.getElementById('coorDeleteBtn');
        const submitBtn = document.getElementById('coorSubmitBtn');

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
            '#coor_address',
            '#coor_personal_email',
            '#coor_department',
            '#coor_username',
            '#coor_password',
        ];

        const updateBtn = document.getElementById('coorUpdateBtn');
        const deleteBtn = document.getElementById('coorDeleteBtn');
        let allFilled = requiredFields.every(selector => $(selector).val().trim() !== '');

        if (updateBtn) updateBtn.disabled = !allFilled;
        if (deleteBtn) deleteBtn.disabled = !allFilled;
    }

    function unlockAndResetForms() {
        const coordinatorForm = document.getElementById('coordinatorForm');

        if (coordinatorForm) {
            coordinatorForm.reset();
            document.querySelectorAll('#coordinatorForm input, #coordinatorForm select').forEach(el => {
                el.disabled = false;
                $(el).on('input change', toggleUpdateButton);
            });
        }

        const coorDepartmentSelect = document.getElementById('coor_department');
        if (coorDepartmentSelect) {
            coorDepartmentSelect.disabled = false;
            coorDepartmentSelect.selectedIndex = 0;
        }

        const submitBtn = document.getElementById('coorSubmitBtn');
        const cancelBtn = document.getElementById('coorCancelBtn');

        if (submitBtn) {
            submitBtn.disabled = false;
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

        if (coordinatorForm) {
            coordinatorForm.reset();
            document.querySelectorAll('#coordinatorForm input, #coordinatorForm select').forEach(el => el.disabled = true);
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

        if (updateBtn) updateBtn.style.display = 'none';
        if (deleteBtn) deleteBtn.style.display = 'none';

        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.style.display = 'inline-block';
        }

        if (cancelBtn) cancelBtn.style.display = 'none';
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

    document.getElementById('coordinatorInfo').addEventListener('click', function (event) {
        if (event.target && event.target.matches('button[data-id]')) {
            unlockAndResetForms();
            showUpdateButton();
            isUpdating = true;
        }
    });

    const cancelBtn = document.getElementById('coorCancelBtn');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function () {
            resetAndLockForms();
        });
    }

    document.querySelectorAll('#coordinatorForm input, #coordinatorForm select').forEach(el => {
        $(el).on('input change', toggleUpdateButton);
    });
}