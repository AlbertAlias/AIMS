function evaluateStudent(userId) {
    $('#student_id').val(userId);
    $.ajax({
        url: 'controller/check-evaluation.php',
        type: 'GET',
        data: { user_id: userId },
        success: function(response) {
            // Ensure response is parsed as JSON
            response = typeof response === 'string' ? JSON.parse(response) : response;

            console.log(response);  // Debugging the response

            if (response.error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.error,
                });
                return;
            }

            // Log individual fields to check if they are empty or null
            console.log('First Name:', response.first_name);
            console.log('Last Name:', response.last_name);
            console.log('Middle Name:', response.middle_name);
            console.log('Department Name:', response.department_name);

            // Construct the name text
            var nameText = "Name of Student: ";
            if (response.last_name || response.first_name) {
                nameText += (response.last_name || '') + ", " + (response.first_name || '');
            } else {
                nameText += 'N/A';  // In case both names are missing
            }

            // Handle middle_name if it's not null
            if (response.middle_name) {
                nameText += " " + response.middle_name;
            }

            // Construct the department text
            var departmentText = "Department: " + (response.department_name || 'N/A');  // Use 'N/A' if department is missing

            console.log("Name Text:", nameText);  // Debugging name
            console.log("Department Text:", departmentText);  // Debugging department

            // Update modal text
            $('#evaluationModal').find('#main p').text(nameText);
            $('#evaluationModal').find('#main1 p').text(departmentText);

            // Show the modal
            $('#evaluationModal').modal('show');
        },
    });
}

$('#evaluationForm').submit(function (e) {
    e.preventDefault();

    const studentId = $('#student_id').val();
    const ratings = {};
    const totalGrade = $('[name^="ratings"]:checked')
        .toArray()
        .reduce((sum, input) => {
            ratings[$(input).attr('name')] = $(input).val();
            return sum + parseInt($(input).val());
        }, 0);

    const comments = $('#comments').val();

    if (Object.keys(ratings).length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Please complete all ratings before submitting!',
        });
        return;
    }

    // Send data to server via AJAX
    $.ajax({
        url: 'controller/create-evaluate.php',
        type: 'POST',
        data: {
            student_id: studentId,
            ratings: JSON.stringify(ratings),
            totalGrade: totalGrade,
            comments: comments,
        },
        success: function (response) {
            Swal.fire({
                icon: 'success',
                title: 'Evaluation Submitted!',
                text: `Total Grade: ${totalGrade}`,
            });
            $('#evaluationModal').modal('hide');
            $('#evaluationForm')[0].reset();
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while submitting the evaluation. Please try again.',
            });
        },
    });
});
