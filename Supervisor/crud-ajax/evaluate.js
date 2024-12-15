function evaluateStudent(userId) {
    // Populate student_id dynamically in modal
    $('#student_id').val(userId);
    $('#evaluateModal').modal('show'); // Open the modal
}

function submitEvaluation() {
    const studentId = $('#student_id').val();
    const evaluationScore = $('#evaluationScore').val();
    const comments = $('#comments').val();

    if (!evaluationScore) {
        alert("Please enter a valid score.");
        return;
    }

    // Simulate sending data to server via AJAX
    $.ajax({
        url: 'controller/evaluate.php', // Your server-side script for handling submission
        type: 'POST',
        data: {
            student_id: studentId,
            evaluation_score: evaluationScore,
            comments: comments,
        },
        success: function(response) {
            alert('Evaluation submitted successfully');
            $('#evaluateModal').modal('hide');
            $('#evaluationForm')[0].reset(); // Reset the modal form
        },
        error: function(error) {
            alert('Error occurred. Please try again.');
        }
    });
}