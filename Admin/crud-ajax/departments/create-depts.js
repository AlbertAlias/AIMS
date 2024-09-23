document.addEventListener('DOMContentLoaded', function() {
    const departmentForm = document.getElementById('departmentForm');
    const submitBtn = document.querySelector('#departmentForm button[type="submit"]');
    
    if (submitBtn) {
        submitBtn.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form from submitting the default way
            const formData = new FormData(departmentForm);
            
            fetch('controller/departments/create-depts.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Department created successfully.');
                    // Reset and lock the form, hide cancel button, and lock submit button
                    resetAndLockForm();
                } else {
                    alert('Error creating department: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    }
});
