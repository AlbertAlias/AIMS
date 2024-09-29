function loadDepartments() {
    $.ajax({
        url: 'controller/coordinators/retrieve-deptsName.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            let departmentSelect = $('#coor_department');
            departmentSelect.empty();
            departmentSelect.append('<option selected disabled>Choose Department</option>');

            if (Array.isArray(response.departments)) {
                response.departments.forEach(function(department) {
                    departmentSelect.append(`<option value="${department.id}">${department.department_name}</option>`); // Updated to use 'id'
                });
            } else {
                console.error('Invalid response structure:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error retrieving departments:', error);
        }
    });
}

$(document).ready(function() {
    loadDepartments(); 
});