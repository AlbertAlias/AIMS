$(document).ready(function () {
    window.loadStudents = function () {
        let studentsInfo = $('#studentsInfo');
        studentsInfo.html('<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>');
        $.ajax({
            url: 'controller/students/retrieve-students.php',
            method: 'GET',
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
                studentsInfo.html('<div class="text-danger">Failed to load students. Please try again later.</div>');
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
    
        $.ajax({
            url: 'controller/students/retrieve-students-info.php',
            method: 'GET',
            data: { user_id: userId },
            dataType: 'json',
            success: function (response) {
                console.log("Response:", response); // Debug the response
    
                if (response.success) {
                    // Populate the form with the retrieved data
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
                        success: function (response) {
                            var departmentDropdown = $('#student_department');
                            departmentDropdown.empty();
                        
                            if (response.success && response.departments.length > 0) {
                                departmentDropdown.append('<option selected>Choose Department</option>');
                                response.departments.forEach(function (department) {
                                    departmentDropdown.append(
                                        $('<option>', {
                                            value: department.department_id,
                                            text: department.department_name,
                                        })
                                    );
                                });
                            } else {
                                departmentDropdown.append('<option selected disabled>No departments available</option>');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error fetching departments:', error);
                        },
                    });
    
                    // Show buttons
                    $('#studentSubmitBtn').hide();
                    $('#studentUpdateBtn').show();
                    $('#studentCancelBtn').show();
                } else {
                    console.error('Failed to fetch student details:', response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                console.error('Response Text:', xhr.responseText);
            },
        });
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
        };
    
        if (!userData.last_name || !userData.first_name || !userData.email || !userData.username || !userData.department_id) {
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
                    $('#studentSubmitBtn').show();  // Show Submit button
                    $('#studentUpdateBtn').hide();  // Hide Update button
                    $('#studentCancelBtn').hide();  // Hide Cancel button
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
        $('#studentSubmitBtn').show();
        $('#studentUpdateBtn').hide();
        $('#studentCancelBtn').hide();
    });

    loadStudents(); // Initially load the student list
});