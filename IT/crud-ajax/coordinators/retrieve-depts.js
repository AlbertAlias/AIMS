window.loadDepartments = function (excludeDeptId) {
    $.ajax({
        url: 'controller/coordinators/retrieve-depts.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            const $select = $('#coor_department');

            // Add available departments excluding the specified one
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
    loadDepartments(); // Load departments on page load
});
