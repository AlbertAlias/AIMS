function evaluateStudent(userId) {
    
    $.ajax({
        url: 'controller/evaluation/retrieve-evaluation.php',
        type: 'GET',
        data: { user_id: userId },
        success: function(response) {
            if (response.alreadyEvaluated) {
                Swal.fire({
                    icon: 'info',
                    title: 'Already Evaluated',
                    text: 'This student has already been evaluated.',
                });
                return;
            }
            $('#student_id').val(userId);
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

    
    $.ajax({
        url: 'controller/evaluation/post-evaluate.php',
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