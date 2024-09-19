document.addEventListener('DOMContentLoaded', function() {
    const departmentInfo = document.getElementById('departmentInfo');

    function fetchDepartments() {
        if (departmentInfo) {
            fetch('controller/departments/retrieve-depts.php')
            .then(response => response.text())  // Read response as text first
            .then(text => {
                try {
                    const data = JSON.parse(text);  // Attempt to parse JSON
                    if (data.success && Array.isArray(data.departments)) {
                        departmentInfo.innerHTML = data.departments.map(dept => 
                            `<button class="btn btn-outline-secondary d-block mb-2 w-100 coordinator-btn" data-id="${dept.id}" data-head="${dept.head}">
                                ${dept.name}
                            </button>`
                        ).join('');
                    } else {
                        alert('Error retrieving departments: ' + data.message);
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.error('Response text:', text);  // Log response text for debugging
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    }

    // Fetch departments on page load
    fetchDepartments();

    // Expose the function for updating the department list
    window.refreshDepartmentList = fetchDepartments;
});