$(document).ready(function () {
    function loadStudentRequirements() {
        $.ajax({
            url: 'controller/requirement/retrieve-student-file.php', // PHP script to fetch data
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    console.log(response.error);
                } else {
                    // Clear the container first
                    $('#requirement').empty();

                    if (response.length === 0) {
                        $('#requirement').html('<p class="text-center mt-3">No student submissions found.</p>');
                        return;
                    }

                    // Iterate through the submissions and display them
                    response.forEach(function (submission) {
                        $('#requirement').append(`
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">${submission.student_name}</h5>
                                    <p class="card-text">Document: ${submission.document_name}</p>
                                    <p class="card-text">Status: <strong>${submission.status}</strong></p>
                                    <button class="btn btn-success approve-btn" data-id="${submission.submit_id}">Approve</button>
                                    <button class="btn btn-danger disapprove-btn" data-id="${submission.submit_id}">Disapprove</button>
                                </div>
                            </div>
                        `);
                    });

                    // Add event listeners for approval/disapproval buttons
                    $('.approve-btn').click(function () {
                        updateStatus($(this).data('id'), 'approved');
                    });

                    $('.disapprove-btn').click(function () {
                        updateStatus($(this).data('id'), 'rejected');
                    });
                }
            },
            error: function() {
                console.log('Error retrieving student requirements.');
            }
        });
    }

    // Function to update the status
    function updateStatus(submitId, status) {
        $.ajax({
            url: 'controller/requirement/update-file-status.php', // Create a PHP script for updating status
            method: 'POST',
            data: { submit_id: submitId, status: status },
            success: function(response) {
                if (response.error) {
                    console.log(response.error);
                } else {
                    loadStudentRequirements(); // Reload the requirements after update
                }
            },
            error: function() {
                console.log('Error updating status.');
            }
        });
    }

    // Load student requirements on page load
    loadStudentRequirements();
});