document.addEventListener('DOMContentLoaded', function () {
    const departmentInfo = document.getElementById('departmentInfo');

    if (departmentInfo) {
        departmentInfo.addEventListener('click', function (event) {
            const button = event.target.closest('.coordinator-btn');
            if (button) {
                const deptId = button.dataset.id;

                // Enable forms and unlock input fields
                if (typeof enableFormForAdd === 'function') {
                    enableFormForAdd(); // Call the globally available function from dept-form-enable.js
                } else {
                    console.error('enableFormForAdd is not defined.');
                }

                // Fetch dean details using the department ID
                fetch(`controller/departments/retrieve-dept-deanInfo.php?dept_id=${deptId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Populate the form fields with the department and dean's information
                            const { department_name, last_name, first_name, username } = data.dean;
                            const departments = data.departments; // All departments for dropdown

                            document.getElementById('department_name').value = department_name;
                            document.getElementById('last_name').value = last_name;
                            document.getElementById('first_name').value = first_name;
                            document.getElementById('username').value = username; 
                            document.getElementById('departmentId').value = deptId;

                            // Update the department select field
                            const deptSelect = document.getElementById('dean_department');
                            if (deptSelect) {
                                deptSelect.disabled = false; // Enable the dropdown
                                deptSelect.innerHTML = ''; // Clear existing options

                                // Populate all departments
                                departments.forEach(dept => {
                                    const option = document.createElement('option');
                                    option.value = dept.department_id;
                                    option.textContent = dept.department_name;

                                    // Mark as selected if it matches the dean's department
                                    if (dept.department_id == deptId) {
                                        option.selected = true;
                                    }

                                    deptSelect.appendChild(option);
                                });
                            }
                        } else {
                            alert('Error retrieving dean information: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching dean details:', error);
                    });
            }
        });
    }
});