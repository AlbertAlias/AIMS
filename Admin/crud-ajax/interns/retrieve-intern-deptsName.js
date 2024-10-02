$(document).ready(function () {
    function loadDepartments() {
        $.ajax({
            url: 'controller/interns/retrieve-intern-deptsName.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    let options = '';
                    // Add default option
                    options += '<option selected disabled>Choose Department</option>'; 
                    response.data.forEach(function (department) {
                        options += `<option value="${department.id}">${department.department_name}</option>`;
                    });
                    $('#intern_department').empty().append(options);
                } else {
                    console.error(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    }

    loadDepartments();
});