document.addEventListener('DOMContentLoaded', function () {
    const departmentForm = document.getElementById('departmentForm');
    const deanForm = document.getElementById('deanForm');
    const deptSubmitBtn = document.querySelector('#departmentForm button[type="submit"]');
    const deanSubmitBtn = document.querySelector('#deanForm button[type="submit"]');
    const deptCancelBtn = document.getElementById('deptCancelBtn');
    const deanCancelBtn = document.getElementById('deanCancelBtn');
    const deptUpdateBtn = document.getElementById('deptUpdateBtn');
    const deanUpdateBtn = document.getElementById('deanUpdateBtn');

    // Initially disable submit buttons and hide cancel buttons
    deptSubmitBtn.disabled = true;
    deanSubmitBtn.disabled = true;

    // Enable department form and dean form for adding data
    function enableFormForAdd() {
        if (departmentForm) {
            departmentForm.reset(); // Reset department form values
            departmentForm.querySelectorAll('input, button').forEach(el => {
                el.disabled = false; // Unlock inputs and buttons
            });
            deptSubmitBtn.disabled = false;
            deptSubmitBtn.style.display = 'inline-block'; // Show submit button
            deptCancelBtn.classList.remove('d-none');
            deptCancelBtn.style.display = 'inline-block'; // Show cancel button
            deptUpdateBtn.style.display = 'none'; // Hide update button
        }

        if (deanForm) {
            deanForm.reset(); // Reset dean form values
            deanForm.querySelectorAll('input, select, button').forEach(el => {
                el.disabled = false; // Unlock inputs, selects, and buttons
            });
            deanSubmitBtn.disabled = false;
            deanSubmitBtn.style.display = 'inline-block'; // Show submit button
            deanCancelBtn.classList.remove('d-none');
            deanCancelBtn.style.display = 'inline-block'; // Show cancel button
            deanUpdateBtn.style.display = 'none'; // Hide update button
        }
    }

    // Reset and lock department form when cancel is clicked
    function resetAndLockDeptForm() {
        departmentForm.reset();
        departmentForm.querySelectorAll('input').forEach(el => {
            el.disabled = true; // Lock inputs
        });
        deptSubmitBtn.disabled = true; // Disable submit button
        deptSubmitBtn.style.display = 'inline-block'; // Show submit button
        deptCancelBtn.style.display = 'none'; // Hide cancel button
        deptUpdateBtn.style.display = 'none'; // Hide update button
    }

    // Reset and lock dean form when cancel is clicked
    function resetAndLockDeanForm() {
        deanForm.reset();
        deanForm.querySelectorAll('input, select').forEach(el => {
            el.disabled = true; // Lock inputs and selects
        });
        deanSubmitBtn.disabled = true; // Disable submit button
        deanSubmitBtn.style.display = 'inline-block'; // Show submit button
        deanCancelBtn.style.display = 'none'; // Hide cancel button
        deanUpdateBtn.style.display = 'none'; // Hide update button
    }

    // Event listener for the "Add Departments" button
    const addDepartmentsBtn = document.getElementById('addDepartmentsBtn');
    if (addDepartmentsBtn) {
        addDepartmentsBtn.addEventListener('click', function () {
            enableFormForAdd(); // Unlock and reset both forms for adding data
        });
    }

    // Add event listener for department cancel button
    if (deptCancelBtn) {
        deptCancelBtn.addEventListener('click', function () {
            resetAndLockDeptForm(); // Reset and lock the department form
        });
    }

    // Add event listener for dean cancel button
    if (deanCancelBtn) {
        deanCancelBtn.addEventListener('click', function () {
            resetAndLockDeanForm(); // Reset and lock the dean form
        });
    }
});