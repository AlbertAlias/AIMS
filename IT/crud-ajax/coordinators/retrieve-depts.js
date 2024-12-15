window.loadDepartments = function (excludeDeptId) {
    $.ajax({
        url: 'controller/coordinators/retrieve-depts.php', // URL of the PHP file that retrieves department data
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            var $select = $('#coor_department');
            $select.empty(); // Clear existing options

            // Add "Choose Department" as the default option
            $select.append('<option selected disabled>Choose Department</option>');

            // Append available departments if any exist
            if (response.success && response.data.length > 0) {
                $.each(response.data, function (index, department) {
                    if (department.id !== excludeDeptId) {
                        $select.append(`<option value="${department.id}">${department.name}</option>`);
                    }
                });
            }
            // If no departments exist, just leave the dropdown empty beyond the default option
        },
        error: function () {
            console.error('An error occurred while fetching the departments.');
        },
    });
};

// Call the loadDepartments function when the page is ready
$(document).ready(function () {
    loadDepartments(); // This will load departments without a coordinator
});