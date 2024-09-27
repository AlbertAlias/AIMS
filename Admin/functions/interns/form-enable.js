function showUpdateButton() {
    const internUpdateBtn = document.getElementById('internUpdateBtn');
    const internSubmitBtn = document.getElementById('internSubmitBtn');

    if (internUpdateBtn) internUpdateBtn.style.display = 'inline-block';
    if (internSubmitBtn) internSubmitBtn.style.display = 'none';
}

function unlockAndResetForms() {
    const internsForm = document.getElementById('internsForm');
    const intern_accountForm = document.getElementById('intern_accountForm');

    if (internsForm) {
        internsForm.reset();
        document.querySelectorAll('#internsForm input, #internsForm select').forEach(el => {
            if (!['coordinator_name', 'coordinator_email', 'intern_password', 'intern_account_email'].includes(el.id)) {
                el.disabled = false;
            }
        });
    }

    if (intern_accountForm) {
        intern_accountForm.reset();
        document.querySelectorAll('#intern_accountForm input').forEach(el => {
            if (el.id !== 'intern_account_email' && el.id !== 'intern_password') {
                el.disabled = false;
            }
        });
    }

    const internSubmitBtn = document.getElementById('internSubmitBtn');
    const internCancelBtn = document.getElementById('internCancelBtn');

    if (internSubmitBtn) {
        internSubmitBtn.disabled = false;
        internSubmitBtn.style.display = 'inline-block';
    }

    if (internCancelBtn) internCancelBtn.style.display = 'inline-block';
}

function disableAndResetForms() {
    const internsForm = document.getElementById('internsForm');
    const intern_accountForm = document.getElementById('intern_accountForm');

    if (internsForm) {
        internsForm.reset();

        const departmentSelect = document.getElementById('intern_department');
        if (departmentSelect) {
            departmentSelect.selectedIndex = 0;
        }

        document.querySelectorAll('#internsForm input, #internsForm select').forEach(el => {
            el.disabled = true;
        });
    }

    if (intern_accountForm) {
        intern_accountForm.reset();
        document.querySelectorAll('#intern_accountForm input').forEach(el => {
            el.disabled = true;
        });
    }

    const internSubmitBtn = document.getElementById('internSubmitBtn');
    const internCancelBtn = document.getElementById('internCancelBtn');
    const internUpdateBtn = document.getElementById('internUpdateBtn');

    if (internSubmitBtn) {
        internSubmitBtn.disabled = true;
        internSubmitBtn.style.display = 'inline-block';
    }

    if (internCancelBtn) {
        internCancelBtn.style.display = 'none';
    }

    if (internUpdateBtn) {
        internUpdateBtn.style.display = 'none';
    }
}

document.getElementById('addInternsBtn').addEventListener('click', function() {
    console.log('Add Interns button clicked');
    unlockAndResetForms();
    loadDepartments(null, true);

    const internUpdateBtn = document.getElementById('internUpdateBtn');
    const internSubmitBtn = document.getElementById('internSubmitBtn');

    if (internUpdateBtn) internUpdateBtn.style.display = 'none';
    if (internSubmitBtn) internSubmitBtn.style.display = 'inline-block';
});


document.getElementById('internsInfo').addEventListener('click', function(event) {
    if (event.target && event.target.matches('button[data-id]')) {
        const internID = event.target.getAttribute('data-id');
        document.getElementById('internID').value = internID;
        console.log('Selected Intern ID:', internID);
        unlockAndResetForms();
        showUpdateButton();
        loadInternInfo(internID);
    }
});

document.getElementById('internCancelBtn').addEventListener('click', function() {
    disableAndResetForms();
    console.log('Cancel button clicked');
    disableAndResetForms();
    console.log('Forms disabled and reset');
    this.style.display = 'none';
    document.getElementById('internUpdateBtn').style.display = 'none';
});