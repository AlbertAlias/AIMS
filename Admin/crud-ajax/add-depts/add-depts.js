document.addEventListener('DOMContentLoaded', function() {
    const departmentForm = document.getElementById('departmentForm');
    const addDepartmentsBtn = document.getElementById('addDepartmentsBtn');
    const departmentInfo = document.getElementById('departmentInfo');
    const submitBtn = departmentForm.querySelector('button[type="submit"]');
    const cancelBtn = document.getElementById('cancelEditBtn');
    const deleteBtn = document.getElementById('deleteDeptBtn');
    let selectedDepartmentId = null;

    // Function to load and display department data
    function loadDepartments() {
        fetch('controller/add-depts/retrieve-depts.php')
            .then(response => response.json())
            .then(data => {
                if (Array.isArray(data)) {
                    departmentInfo.innerHTML = data.map(department => `
                        <button class="btn btn-outline-secondary d-block mb-2 w-100" data-id="${department.id}" data-name="${department.name}" data-head="${department.head}">
                            ${department.name}
                        </button>
                    `).join('');
                    
                    // Add event listeners to each department button
                    departmentInfo.querySelectorAll('button').forEach(button => {
                        button.addEventListener('click', function() {
                            const name = this.getAttribute('data-name');
                            const head = this.getAttribute('data-head');
                            selectedDepartmentId = this.getAttribute('data-id'); // Store selected department ID

                            document.getElementById('departmentName').value = name;
                            document.getElementById('departmentHead').value = head;

                            // Enable the form for editing
                            departmentForm.querySelectorAll('input').forEach(el => el.disabled = false);
                            submitBtn.style.display = 'inline-block';
                            cancelBtn.style.display = 'inline-block';
                            deleteBtn.style.display = 'inline-block';

                            // Hide the Add Departments button
                            addDepartmentsBtn.style.display = 'inline-block';
                        });
                    });
                } else {
                    departmentInfo.innerHTML = '<p class="text-danger">No departments found.</p>';
                }
            })
            .catch(error => {
                departmentInfo.innerHTML = `<p class="text-danger">Error: ${error.message}</p>`;
            });
    }

    // Initial load
    loadDepartments();

    if (addDepartmentsBtn) {
        addDepartmentsBtn.addEventListener('click', function() {
            // Enable the form inputs for adding a new department
            departmentForm.reset(); // Clear form fields
            departmentForm.querySelectorAll('input').forEach(el => el.disabled = false);
            submitBtn.style.display = 'inline-block';
            cancelBtn.style.display = 'none';
            deleteBtn.style.display = 'none';

            // Show the Add Departments button
            addDepartmentsBtn.style.display = 'inline-block';
            selectedDepartmentId = null; // Reset selected department ID
        });
    }

    if (departmentForm) {
        departmentForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const departmentName = document.getElementById('departmentName').value;
            const departmentHead = document.getElementById('departmentHead').value;

            // Determine the request URL and method based on whether we're adding or updating
            const url = selectedDepartmentId === null 
                ? 'controller/add-depts/create-depts.php' 
                : 'controller/add-depts/update-depts.php';

            const method = selectedDepartmentId === null ? 'POST' : 'PUT';

            // AJAX request to send data
            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id: selectedDepartmentId,
                    departmentName: departmentName,
                    departmentHead: departmentHead,
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadDepartments(); // Reload departments

                    // Reset the form and hide additional buttons
                    departmentForm.reset();
                    departmentForm.querySelectorAll('input').forEach(el => el.disabled = true);
                    submitBtn.style.display = 'inline-block';
                    cancelBtn.style.display = 'none';
                    deleteBtn.style.display = 'none';

                    // Show the Add Departments button
                    addDepartmentsBtn.style.display = 'inline-block';
                } else {
                    departmentInfo.innerHTML = `<p class="text-danger">Error: ${data.message}</p>`;
                }
            })
            .catch(error => {
                departmentInfo.innerHTML = `<p class="text-danger">Error: ${error.message}</p>`;
            });
        });

        // Handle Cancel button click
        cancelBtn.addEventListener('click', function() {
            departmentForm.reset();
            departmentForm.querySelectorAll('input').forEach(el => el.disabled = true);
            submitBtn.style.display = 'inline-block';
            cancelBtn.style.display = 'none';
            deleteBtn.style.display = 'none';

            // Show the Add Departments button
            addDepartmentsBtn.style.display = 'inline-block';
        });

        // Handle Delete button click
        deleteBtn.addEventListener('click', function() {
            if (selectedDepartmentId !== null) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will permanently delete the department!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('controller/add-depts/delete-depts.php', {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ id: selectedDepartmentId }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                loadDepartments(); // Reload departments

                                // Reset the form
                                departmentForm.reset();
                                departmentForm.querySelectorAll('input').forEach(el => el.disabled = true);
                                submitBtn.style.display = 'inline-block';
                                cancelBtn.style.display = 'none';
                                deleteBtn.style.display = 'none';

                                // Show the Add Departments button
                                addDepartmentsBtn.style.display = 'inline-block';
                            } else {
                                departmentInfo.innerHTML = `<p class="text-danger">Error: ${data.message}</p>`;
                            }
                        })
                        .catch(error => {
                            departmentInfo.innerHTML = `<p class="text-danger">Error: ${error.message}</p>`;
                        });
                    }
                });
            }
        });
    }
});