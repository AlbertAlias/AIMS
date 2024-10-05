document.addEventListener('DOMContentLoaded', function() {
    const departmentForm = document.getElementById('departmentForm');
    const addDepartmentsBtn = document.getElementById('addDepartmentsBtn');
    const submitBtn = document.querySelector('#departmentForm button[type="submit"]');
    const updateBtn = document.getElementById('updateBtn');
    const cancelEditBtn = document.getElementById('cancelEditBtn');
    const deleteDeptBtn = document.getElementById('deleteDeptBtn');

    submitBtn.disabled = true;

    function enableFormForAdd() {
        if (departmentForm) {
            departmentForm.reset();
            departmentForm.querySelectorAll('input, button').forEach(el => el.disabled = false);
            submitBtn.disabled = false;
            submitBtn.style.display = 'inline-block';
            updateBtn.style.display = 'none';
            cancelEditBtn.style.display = 'inline-block';
            deleteDeptBtn.style.display = 'none';
            console.log('Form reset and enabled for adding');
        }
    }

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

    function resetAndLockForm() {
        if (departmentForm) {
            departmentForm.reset();
            departmentForm.querySelectorAll('input, button').forEach(el => el.disabled = true);
            submitBtn.style.display = 'inline-block';
            updateBtn.style.display = 'none';
            cancelEditBtn.style.display = 'none';
            deleteDeptBtn.style.display = 'none';
            console.log('Form reset and locked');
        }
    }

    if (addDepartmentsBtn) {
        addDepartmentsBtn.addEventListener('click', function() {
            enableFormForAdd();
            cancelEditBtn.style.display = 'inline-block';
        });
    }

    if (cancelEditBtn) {
        cancelEditBtn.addEventListener('click', function() {
            resetAndLockForm();
        });
    }

    document.getElementById('departmentInfo').addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('coordinator-btn')) {
            const departmentId = event.target.getAttribute('data-id');
            const departmentHead = event.target.getAttribute('data-head');
            const departmentName = event.target.innerText.split('\n')[0].trim(); // Assuming the department name is before a line break
    
            const department = {
                id: departmentId,
                name: departmentName,
                head: departmentHead
            };
            enableFormForUpdate(department);
        }
    });

    window.resetAndLockForm = resetAndLockForm;
});