document.addEventListener('DOMContentLoaded', function() {
    // Get the form and button elements
    const departmentForm = document.getElementById('departmentForm');
    const addDepartmentsBtn = document.getElementById('addDepartmentsBtn');
    
    // Add event listener to the button
    if (addDepartmentsBtn) {
        addDepartmentsBtn.addEventListener('click', function() {
            // Enable the form inputs
            if (departmentForm) {
                departmentForm.querySelectorAll('input, button').forEach(el => el.disabled = false);
            }
        });
    }
});
