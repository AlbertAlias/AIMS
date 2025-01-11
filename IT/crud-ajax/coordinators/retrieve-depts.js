window.loadDepartments = function (excludeDeptId) {
    $.ajax({
        url: 'controller/coordinators/retrieve-depts.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            const $select = $('#coor_department');
            $select.empty(); // Clear existing options
            $select.append('<option selected>Choose Department</option>'); // Add default option

            if (response.success && response.data.length > 0) {
                response.data.forEach(function (department) {
                    if (department.id !== excludeDeptId) {
                        $select.append(`<option value="${department.id}">${department.name}</option>`);
                    }
                });
            }
        },
        error: function () {
            console.error('An error occurred while fetching the departments.');
        },
    });
};

$(document).ready(function () {
    loadDepartments();
});