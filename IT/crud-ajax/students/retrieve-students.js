$(document).ready(function () {
    window.loadStudents = function () {
        $.ajax({
            url: 'controller/students/retrieve-students.php',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    window.students = response.students;
                    updateStudentsList(window.students);
                } else {
                    console.error('Failed to load students:', response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Failed to load students:', error);
                console.error('Response Text:', xhr.responseText); // Debug response
            },
        });
    };

    function updateStudentsList(students, message = null) {
        let studentsInfo = $('#studentsInfo');
        studentsInfo.empty();

        // If a message is provided, display it
        if (message) {
            studentsInfo.append(`<div class="text-danger">${message}</div>`);
            return;
        }

        // Limit the number of students displayed to 10
        const limitedStudents = students.slice(0, 6);

        // If no students found, display a message
        if (limitedStudents.length === 0) {
            updateStudentsList([], 'No students found');
            return;
        }

        limitedStudents.forEach(function (student) {
            let btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 coor-btn" data-id="${student.id}">
                        ${student.last_name}, ${student.first_name}<br>${student.department_name}
                        </button>`;
            studentsInfo.append(btn);
        });
    }

    // When a student button is clicked, fetch and populate their details
    $(document).on('click', '.coor-btn', function () {
        var userId = $(this).data('id'); // Get the ID of the selected students

        $.ajax({
            url: 'controller/coordinators/retrieve-coor-info.php',
            method: 'GET',
            data: { user_id: userId },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#studentID').val(userId);
                    $('#student_last_name').val(response.last_name);
                    $('#student_first_name').val(response.first_name);
                    $('#student_middle_name').val(response.middle_name);
                    $('#student_personal_email').val(response.email);
                    $('#student_username').val(response.username);

                    // Select the correct department in the dropdown
                    function setDepartment() {
                        if ($('#student_department option').length > 0) {
                            $('#student_department').val(response.department_id);
                        } else {
                            setTimeout(setDepartment, 100); // Retry until dropdown is ready
                        }
                    }
                    setDepartment();

                    // Show the Update and Cancel buttons, and hide the Submit button
                    $('#studentSubmitBtn').hide();
                    $('#studentUpdateBtn').show();
                    $('#studentCancelBtn').show();
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            },
        });
    });

    $('#studentUpdateBtn').click(function () {
        const userData = {
            user_id: $('#studentsID').val(),
            last_name: $('#students_last_name').val(),
            first_name: $('#students_first_name').val(),
            middle_name: $('#students_middle_name').val(),
            email: $('#students_personal_email').val(),
            username: $('#students_username').val(),
            department_id: $('#students_department').val(),
        };

        // Validate required fields
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

        // Send AJAX request to update student details
        $.ajax({
            url: 'controller/coordinators/update-coor.php', // PHP script to handle updates
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

                    loadStudents(); // Reload the student list
                    $('#studentsForm')[0].reset(); // Reset the form
                    $('#studentSubmitBtn').show(); // Show Submit button
                    $('#studentUpdateBtn').hide(); // Hide Update button
                    $('#studentCancelBtn').hide(); // Hide Cancel button
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
                console.error('Response Text:', xhr.responseText); // Debugging info

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
        $('#studentForm')[0].reset();

        // Hide the Update and Cancel buttons, and show the Submit button
        $('#studentSubmitBtn').show();
        $('#studentUpdateBtn').hide();
        $('#studentCancelBtn').hide();
    });

    loadStudents(); // Initially load the student list
});