document.addEventListener('DOMContentLoaded', function () {
    const departmentForm = document.getElementById('departmentForm');
    const departmentIdInput = document.getElementById('departmentId');
    const departmentNameInput = document.getElementById('department_name');
    const lastNameInput = document.getElementById('last_name');
    const firstNameInput = document.getElementById('first_name');
    const usernameInput = document.getElementById('username');

    // Add event delegation for department buttons
    departmentInfo.addEventListener('click', function (event) {
        const button = event.target.closest('.coordinator-btn');
        if (button) {
            const deptId = button.dataset.id;

            // Fetch dean details using the department ID
            fetch(`controller/departments/retrieve-deptsInfo.php?dept_id=${deptId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Populate the form fields with the dean's information
                        const { id, department_name, last_name, first_name, username } = data.dean;
                        departmentIdInput.value = id;
                        departmentNameInput.value = department_name;
                        lastNameInput.value = last_name;
                        firstNameInput.value = first_name;
                        usernameInput.value = username; // Handle if password isn't provided
                    } else {
                        alert('Error retrieving dean information: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error fetching dean details:', error);
                });
        }
    });
});
