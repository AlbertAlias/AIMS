// function evaluateStudent(userId) {
//     // Populate student_id dynamically in modal
//     $('#student_id').val(userId);
//     $('#evaluateModal').modal('show'); // Open the modal
// }

// function submitEvaluation() {
//     const studentId = $('#student_id').val();
//     const evaluationScore = $('#evaluationScore').val();
//     const comments = $('#comments').val();

//     if (!evaluationScore) {
//         alert("Please enter a valid score.");
//         return;
//     }

//     // Simulate sending data to server via AJAX
//     $.ajax({
//         url: 'controller/evaluate.php', // Your server-side script for handling submission
//         type: 'POST',
//         data: {
//             student_id: studentId,
//             evaluation_score: evaluationScore,
//             comments: comments,
//         },
//         success: function(response) {
//             alert('Evaluation submitted successfully');
//             $('#evaluateModal').modal('hide');
//             $('#evaluationForm')[0].reset(); // Reset the modal form
//         },
//         error: function(error) {
//             alert('Error occurred. Please try again.');
//         }
//     });
// }

// function evaluateStudent(userId) {
//     $('#student_id').val(userId);
//     $('#evaluateModal').modal('show');
// }

// function submitEvaluation() {
//     const studentId = $('#student_id').val();
//     const qualityOfWork = parseInt($('#quality_of_work').val());
//     const productivity = parseInt($('#productivity').val());
//     const workHabits = parseInt($('#work_habits').val());
//     const interpersonalRelationships = parseInt($('#interpersonal_relationships').val());
//     const comments = $('#comments').val();

//     if (
//         !qualityOfWork || 
//         !productivity || 
//         !workHabits || 
//         !interpersonalRelationships
//     ) {
//         alert("Please fill in all fields with valid ratings between 1 and 5.");
//         return;
//     }

//     // Calculate total grade
//     const totalGrade = qualityOfWork + productivity + workHabits + interpersonalRelationships;

//     // Send data to server
//     $.ajax({
//         url: 'controller/evaluate.php',
//         type: 'POST',
//         data: {
//             student_id: studentId,
//             quality_of_work: qualityOfWork,
//             productivity: productivity,
//             work_habits: workHabits,
//             interpersonal_relationships: interpersonalRelationships,
//             total_grade: totalGrade,
//             comments: comments,
//         },
//         success: function(response) {
//             alert(`Evaluation submitted successfully. Total Grade: ${totalGrade}`);
//             $('#evaluateModal').modal('hide');
//             $('#evaluationForm')[0].reset();
//         },
//         error: function() {
//             alert('Error occurred. Please try again.');
//         }
//     });
// }



function evaluateStudent(userId) {
    $('#student_id').val(userId);
    $('#evaluationModal').modal('show');
}

function submitEvaluation() {
    const studentId = $('#student_id').val();
    const ratings = [];
    const formRatings = $('[name^="ratings"]');
    let totalGrade = 0;

    formRatings.each(function() {
        const score = parseInt($(this).val(), 10);
        ratings.push(score);
        totalGrade += score; // Compute the sum of all ratings
    });

    const comments = $('#comments').val();

    // Send the data to server via AJAX
    $.ajax({
        url: 'controller/evaluate.php',
        type: 'POST',
        data: {
            student_id: studentId,
            ratings: JSON.stringify(ratings),
            totalGrade: totalGrade,
            comments: comments,
        },
        success: function(response) {
            alert('Evaluation submitted successfully. Total Grade: ' + totalGrade);
            $('#evaluationModal').modal('hide');
            $('#evaluationForm')[0].reset();
        },
        error: function(error) {
            alert('Error occurred. Please try again.');
        }
    });
}
