$(document).ready(function () {
    $('#deanUpdateBtn').on('click', function () {
        const formData = {
            last_name: $('#update_last_name').val(),
            first_name: $('#update_first_name').val(),
            dean_department: $('#update_dean_department').val(),
            username: $('#update_username').val(),
            password: $('#update_password').val()
        };

        $.ajax({
            url: 'controller/departments/update-dean-info.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                try {
                    const res = JSON.parse(response);
                    if (res.success) {
                        alert('Dean information updated successfully!');
                        $('#editDeanModal').modal('hide');
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        alert(res.error || 'Failed to update dean information.');
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    alert('An error occurred. Please try again.');
                }
            },
            error: function () {
                alert('An error occurred. Please try again.');
            }
        });
    });

    // Prepopulate department dropdown
    $('#editDeanModal').on('show.bs.modal', function () {
        const departmentSelect = $('#update_dean_department');
        departmentSelect.empty();
        departmentSelect.append('<option selected disabled>Loading...</option>');

        $.ajax({
            url: 'controller/departments/retrieve-dean-deptsName.php',
            type: 'GET',
            success: function (response) {
                departmentSelect.empty();
                if (response.success) {
                    response.departments.forEach(department => {
                        departmentSelect.append(
                            `<option value="${department.id}">${department.department_name}</option>`
                        );
                    });
                } else {
                    departmentSelect.append('<option selected disabled>No departments found</option>');
                }
            },
            error: function () {
                departmentSelect.append('<option selected disabled>Error loading departments</option>');
            }
        });
    });
});
