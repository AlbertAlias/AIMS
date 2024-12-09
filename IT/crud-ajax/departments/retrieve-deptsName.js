$(document).ready(function() {
    window.loadDepartmentNames = function() {
        $.ajax({
            url: 'controller/departments/retrieve-deptsName.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Store the fetched department names for filtering
                    window.departments = response.departments;
                    updateDepartmentList(window.departments);
                } else {
                    console.error('Failed to load department names:', response.message);
                    alert('Error: ' + response.message);  // Show an alert with the error message
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to load department names:', error);
                alert('Error: Failed to load department names. Please try again later.');
            }
        });
    };

    // Function to update the department list
    function updateDepartmentList(departments, message = null) {
        let departmentInfo = $('#departmentInfo');
        departmentInfo.empty();

        if (message) {
            departmentInfo.append(`<div class="text-danger">${message}</div>`);
            return;
        }

        // Limit the number of departments displayed to 10
        const limitedDepartments = departments.slice(0, 10);

        // If no departments found, display a message
        if (limitedDepartments.length === 0) {
            updateDepartmentList([], 'No departments found');
            return;
        }

        limitedDepartments.forEach(function(department) {
            let btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 coor-btn" data-id="${department.department_name}">
                        ${department.department_name}
                        </button>`;
            departmentInfo.append(btn);
        });
    }

    // Add search functionality
    $('#searchDepartments').on('input', function() {
        const query = $(this).val().toLowerCase().trim();
        const filteredDepartments = window.departments.filter(department =>
            department.department_name.toLowerCase().includes(query)
        );

        // Logic to show messages based on what was searched
        if (filteredDepartments.length > 0) {
            updateDepartmentList(filteredDepartments);
        } else if (query.length > 0) {
            updateDepartmentList([], 'No matching departments found');
        } else {
            updateDepartmentList([]);  // Clear the list if search is empty
        }
    });

    loadDepartmentNames(); // Call to load department names

    // Expose the function for updating the department list
    window.refreshDepartmentList = loadDepartmentNames;
});