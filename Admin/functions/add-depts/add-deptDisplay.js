document.addEventListener('DOMContentLoaded', function() {
    const departmentForm = document.getElementById('departmentForm');
    const addDepartmentsBtn = document.getElementById('addDepartmentsBtn');
    const submitBtn = document.querySelector('#departmentForm button[type="submit"]');
    const updateBtn = document.getElementById('updateBtn');
    const cancelEditBtn = document.getElementById('cancelEditBtn');
    const deleteDeptBtn = document.getElementById('deleteDeptBtn');

    // Function to enable form for adding a department
    function enableFormForAdd() {
        if (departmentForm) {
            departmentForm.querySelectorAll('input, button').forEach(el => el.disabled = false);
            submitBtn.style.display = 'inline-block';
            updateBtn.style.display = 'none';
            cancelEditBtn.style.display = 'inline-block';
            deleteDeptBtn.style.display = 'none';
            console.log('Form enabled for adding');
        }
    }

    // Function to enable form for updating a department
    function enableFormForUpdate(department) {
        if (departmentForm) {
            departmentForm.querySelectorAll('input, button').forEach(el => el.disabled = false);
            submitBtn.style.display = 'none';
            updateBtn.style.display = 'inline-block';
            cancelEditBtn.style.display = 'inline-block';
            deleteDeptBtn.style.display = 'inline-block';

            document.getElementById('departmentId').value = department.id;
            document.getElementById('departmentName').value = department.name;
            document.getElementById('departmentHead').value = department.head;

            console.log('Form enabled for updating department:', department);
        }
    }

    // Function to reset and lock the form after update
    function resetAndLockForm() {
        if (departmentForm) {
            departmentForm.reset();
            departmentForm.querySelectorAll('input, button').forEach(el => el.disabled = true);
            submitBtn.style.display = 'inline-block'; // Show submit button for new entry
            updateBtn.style.display = 'none'; // Hide update button
            cancelEditBtn.style.display = 'none'; // Hide cancel button
            deleteDeptBtn.style.display = 'none'; // Hide delete button
            console.log('Form reset and locked');
        }
    }

    // Event listener for 'Add Departments' button
    if (addDepartmentsBtn) {
        addDepartmentsBtn.addEventListener('click', function() {
            enableFormForAdd();
        });
    }

    // Event listener for 'Cancel' button
    if (cancelEditBtn) {
        cancelEditBtn.addEventListener('click', function() {
            resetAndLockForm();
        });
    }

    // Event listener for clicking department buttons
    document.getElementById('departmentInfo').addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('coordinator-btn')) {
            const departmentId = event.target.getAttribute('data-id');
            const departmentHead = event.target.getAttribute('data-head');
            const department = {
                id: departmentId,
                name: event.target.textContent.trim(),
                head: departmentHead
            };
            enableFormForUpdate(department);
        }
    });

    // Make resetAndLockForm globally accessible
    window.resetAndLockForm = resetAndLockForm;
});