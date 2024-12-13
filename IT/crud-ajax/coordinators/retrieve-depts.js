window.loadDepartments = function (excludeDeptId) {
    $.ajax({
        url: 'controller/coordinators/retrieve-depts.php', // URL of the PHP file that retrieves department data
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                var $select = $('#coor_department');
                
                // Loop through the departments and append them as options, excluding the coordinator's department
                $.each(response.data, function (index, department) {
                    // Only add the department if it's not the coordinator's department
                    if (department.id !== excludeDeptId) {
                        $select.append('<option value="' + department.id + '">' + department.name + '</option>');
                    }
                });
            } else {
                alert('Error fetching departments: ' + response.error);
            }
        },
        error: function () {
            alert('An error occurred while fetching the departments.');
        },
    });
};

// Call the loadDepartments function when the page is ready
$(document).ready(function () {
    loadDepartments(); // This will load departments without a coordinator
});
