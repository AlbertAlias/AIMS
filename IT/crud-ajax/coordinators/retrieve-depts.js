$(document).ready(function () {
    // Function to populate the department select box
    function loadDepartments() {
        $.ajax({
            url: 'controller/coordinators/retrieve-depts.php', // URL of the PHP file that retrieves department data
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    var $select = $('#coor_department');
                    $select.empty(); // Clear any existing options
                    $select.append('<option selected disabled>Choose Department</option>'); // Add default option

                    // Loop through the departments and append them as options
                    $.each(response.data, function (index, department) {
                        $select.append('<option value="' + department.id + '">' + department.name + '</option>');
                    });
                } else {
                    alert('Error fetching departments: ' + response.error);
                }
            },
            error: function () {
                alert('An error occurred while fetching the departments.');
            },
        });
    }

    // Call the loadDepartments function when the page is ready
    loadDepartments();
});