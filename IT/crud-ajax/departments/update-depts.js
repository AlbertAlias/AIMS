document.addEventListener('DOMContentLoaded', function () {
    const departmentForm = document.getElementById('departmentForm');
    const updateBtn = document.getElementById('deptUpdateBtn');
    const deptSubmitBtn = document.getElementById('deptSubmitBtn');
    const deptCancelBtn = document.getElementById('deptCancelBtn');

    if (!departmentForm || !updateBtn || !deptSubmitBtn || !deptCancelBtn) {
        console.error('Form or buttons not found.');
        return;
    }

    // Handle the Update button click
    updateBtn.addEventListener('click', function (event) {
        event.preventDefault();
        console.log('Update button clicked');

        const formData = new FormData(departmentForm);

        // Log form data for debugging
        for (const [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        fetch('controller/departments/update-depts.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text()) // Debug raw response
        .then(data => {
            console.log('Raw response:', data); // Log raw response
            try {
                const jsonData = JSON.parse(data); // Parse JSON
                if (jsonData.success) {
                    console.log('Department updated successfully');
                    
                    // Reset and lock the form fields
                    departmentForm.reset();
                    Array.from(departmentForm.elements).forEach(element => {
                        element.disabled = true; // Lock input fields
                    });

                    // Hide the update and cancel buttons
                    updateBtn.style.display = 'none';
                    deptCancelBtn.style.display = 'none';

                    // Show the submit button but disabled
                    deptSubmitBtn.style.display = 'inline-block';
                    deptSubmitBtn.disabled = true;

                    // Success message
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: 'Department updated successfully',
                        showConfirmButton: false,
                        timer: 3000,
                    });
                } else {
                    console.error('Error updating department:', jsonData.message);
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'error',
                        title: `Error: ${jsonData.message}`,
                        showConfirmButton: false,
                        timer: 3000,
                    });
                }
            } catch (err) {
                console.error('JSON parsing error:', err);
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'error',
                    title: 'Invalid server response',
                    showConfirmButton: false,
                    timer: 3000,
                });
            }
        })
        .catch(error => {
            console.error('Network or fetch error:', error);
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'error',
                title: 'An unexpected error occurred',
                showConfirmButton: false,
                timer: 3000,
            });
        });
    });
});