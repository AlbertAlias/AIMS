$(document).ready(function () {
    window.students = [];

    window.loadStudents = function (searchTerm = '') {
        $.ajax({
            url: 'controller/students/retrieve-students.php',
            method: 'GET',
            data: { searchTerm: searchTerm },
            dataType: 'json',
            success: function (response) {
                if (response.success && response.students && response.students.length > 0) {
                    window.students = response.students;
                    updateStudentsList(window.students);
                } else {
                    // No message displayed here, only the image will be shown
                    updateStudentsList([], '');
                }
            },
            error: function (xhr, status, error) {
                console.error('Failed to load students:', error);
                $('#studentsInfo').html('<div class="text-danger">Failed to load students. Please try again later.</div>');
            },
        });
    };

    function updateStudentsList(students, message = null) {
        let studentsInfo = $('#studentsInfo');
        studentsInfo.empty();
    
        if (message) {
            studentsInfo.html(`<div class="alert alert-info">${message}</div>`);
            return;
        }
    
        if (students.length === 0) {
            // Show an image when no students are found
            studentsInfo.html(`
                <div class="text-center">
                    <img src="../assets/img/notfound.png" alt="No Students Available" style="margin-top: 3px; margin-left: 8px; max-width: 50%; height: auto;">
                </div>
            `);
            return;
        }
    
        students.forEach(function (student) {
            let btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 stud-btn" data-id="${student.id}">
                       ${student.last_name}, ${student.first_name}<br>${student.department_name}
                       </button>`;
            studentsInfo.append(btn);
        });
    }

    $(document).on('click', '.stud-btn', function () {
        var userId = $(this).data('id');
    
        $('#studentUpdateBtn').prop('disabled', false);
        $('#studentCancelBtn').show();
    
        $.ajax({
            url: 'controller/students/retrieve-students-info.php',
            method: 'GET',
            data: { user_id: userId },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#student_id').val(userId);
                    $('#student_last_name').val(response.last_name);
                    $('#student_first_name').val(response.first_name);
                    $('#student_gender').val(response.gender);
                    $('#studentID').val(response.studentID);
                    $('#student_email').val(response.email);
                    $('#student_username').val(response.username);
    
                    $.ajax({
                        url: 'controller/students/retrieve-depts.php',
                        method: 'GET',
                        dataType: 'json',
                        success: function (deptResponse) {
                            var departmentDropdown = $('#student_department');
                            departmentDropdown.empty();
    
                            if (deptResponse.success && deptResponse.departments.length > 0) {
                                departmentDropdown.append('<option selected>Choose Department</option>');
                                deptResponse.departments.forEach(function (department) {
                                    departmentDropdown.append(
                                        $('<option>', {
                                            value: department.department_id,
                                            text: department.department_name,
                                        })
                                    );
                                });
                                departmentDropdown.val(String(response.department_id));
                            } else {
                                departmentDropdown.append('<option selected disabled>No departments available</option>');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error fetching departments:', error);
                        },
                    });
                } else {
                    console.error('Failed to fetch student details:', response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            },
        });
    });

    $('#searchStudents').on('input', function () {
        const searchTerm = $(this).val().toLowerCase();
        window.loadStudents(searchTerm);
    });

    $('#studentUpdateBtn').click(function () {
        const userData = {
            user_id: $('#student_id').val(),
            last_name: $('#student_last_name').val(),
            first_name: $('#student_first_name').val(),
            email: $('#student_email').val(),
            username: $('#student_username').val(),
            department_id: $('#student_department').val(),
            password: $('#student_password').val(),
        };
    
        if (!userData.last_name || !userData.first_name || !userData.username || !userData.department_id) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Please fill in all the required fields!',
                showConfirmButton: false,
                timer: 3000,
                background: '#f8bbd0',
                iconColor: '#c62828',
                color: '#721c24',
                customClass: {
                    popup: 'mt-5'
                }
            });
            return;
        }
    
        $.ajax({
            url: 'controller/students/update-students.php',
            method: 'POST',
            data: userData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Student information updated successfully!',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
    
                    loadStudents();
                    $('#studentsForm')[0].reset();
                    $('#studentUpdateBtn').prop('disabled', true);
                    $('#studentCancelBtn').hide();

                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: response.message || 'An unexpected error occurred.',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#f8bbd0',
                        iconColor: '#c62828',
                        color: '#721c24',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error('Error updating student:', error);
                console.error('Response Text:', xhr.responseText);
    
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'An unexpected error occurred',
                    showConfirmButton: false,
                    timer: 3000,
                    background: '#f8bbd0',
                    iconColor: '#c62828',
                    color: '#721c24',
                    customClass: {
                        popup: 'mt-5'
                    }
                });
            },
        });
    });

    $('#studentCancelBtn').click(function () {
        $('#studentsForm')[0].reset();
    
        $('#student_department').val('Choose Department');
    
        $('#studentUpdateBtn').prop('disabled', true);
        $('#studentCancelBtn').hide();
    });

    loadStudents();
});