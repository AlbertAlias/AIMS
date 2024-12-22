$(document).ready(function () {
    window.students = [];

    window.loadStudents = function (searchTerm = '') {
        $.ajax({
            url: 'controller/students/retrieve-students.php',
            method: 'GET',
            data: { searchTerm: searchTerm },  // Send the search term to the backend
            dataType: 'json',
            success: function (response) {
                if (response.success && response.students && response.students.length > 0) {
                    window.students = response.students;
                    updateStudentsList(window.students);
                } else {
                    updateStudentsList([], 'No students available yet.'); // Empty state message
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

        // If a message is provided, display it
        if (message) {
            studentsInfo.html(`<div class="alert alert-info">${message}</div>`);
            return;
        }

        // If students are available, display them
        if (students.length === 0) {
            studentsInfo.html('<div class="alert alert-info">No students found for the selected department.</div>');
            return;
        }

        students.forEach(function (student) {
            let btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 coor-btn" data-id="${student.id}">
                       ${student.last_name}, ${student.first_name}<br>${student.department_name}
                       </button>`;
            studentsInfo.append(btn);
        });
    }

    // When a student button is clicked, fetch and populate their details
    $(document).on('click', '.coor-btn', function () {
        var userId = $(this).data('id'); // Get the ID of the selected student
        console.log("Clicked user ID:", userId);
    
        $('#studentUpdateBtn').prop('disabled', false);  // Show update button
        $('#studentCancelBtn').show();  // Show cancel button
    
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
    
                    // Fetch department options
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
    
                                // Set the selected department
                                console.log('Setting department:', response.department_id);
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
        window.loadStudents(searchTerm); // Pass the search term to load students
    });

    $('#studentUpdateBtn').click(function () {
        console.log("Update button clicked!");
    
        const userData = {
            user_id: $('#student_id').val(),
            last_name: $('#student_last_name').val(),
            first_name: $('#student_first_name').val(),
            email: $('#student_email').val(),
            username: $('#student_username').val(),
            department_id: $('#student_department').val(),
            password: $('#student_password').val(),  // Include password field
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

    // Cancel the update and reset the form
    $('#studentCancelBtn').click(function () {
        // Reset the form fields
        $('#studentsForm')[0].reset();
    
        // Reset the "Choose Department" option explicitly
        $('#student_department').val('Choose Department');
    
        // Hide the Update and Cancel buttons, and show the Submit button
        $('#studentUpdateBtn').prop('disabled', true);
        $('#studentCancelBtn').hide();
    });

    loadStudents(); // Initially load the student list
});