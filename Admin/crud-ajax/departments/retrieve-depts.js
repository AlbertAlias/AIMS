document.addEventListener('DOMContentLoaded', function() {
    const departmentInfo = document.getElementById('departmentInfo');
    const searchInput = document.getElementById('searchDepartments');

    function fetchDepartments() {
        if (departmentInfo) {
            fetch('controller/departments/retrieve-depts.php')
                .then(response => response.text())
                .then(text => {
                    try {
                        const data = JSON.parse(text);
                        if (data.success && Array.isArray(data.departments)) {
                            // Store departments in a variable for filtering
                            window.departments = data.departments;
                            updateDepartmentList(window.departments);
                        } else {
                            alert('Error retrieving departments: ' + data.message);
                        }
                    } catch (e) {
                        console.error('Error parsing JSON:', e);
                        console.error('Response text:', text);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }

    function updateDepartmentList(departments) {
        departmentInfo.innerHTML = departments.map(dept => 
            `<button class="btn btn-outline-secondary d-block mb-2 w-100 coordinator-btn" data-id="${dept.id}" data-head="${dept.head}">
                ${dept.name}<br>${dept.head}
            </button>`
        ).join('');
    }

    // Search functionality
    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const filteredDepartments = window.departments.filter(dept => 
            dept.name.toLowerCase().includes(query) || dept.head.toLowerCase().includes(query)
        );
        updateDepartmentList(filteredDepartments);
    });

    // Fetch departments on page load
    fetchDepartments();
    window.refreshDepartmentList = fetchDepartments;
});