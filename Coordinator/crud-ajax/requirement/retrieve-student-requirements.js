$(document).ready(function () {
    $('#viewRequirementsModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var userId = button.data('user-id');
        loadStudentRequirements(userId);
    });

    function loadStudentRequirements(userId) {
        $.ajax({
            url: 'controller/requirement/retrieve-student-requirements.php',
            method: 'POST',
            data: { user_id: userId },
            success: function (response) {
                try {
                    if (typeof response === 'string') {
                        response = JSON.parse(response);
                    }
    
                    // Clear all sections
                    $('#pendingRequirements, #approvedRequirements, #rejectedRequirements').empty();
    
                    if (response && response.status === 'success') {
                        const data = response.data;
    
                        if (data.length === 0) {
                            // If no submissions, display the message in all tabs
                            $('#pendingRequirements').html('<p class="text-center text-muted">Student hasn\'t submitted anything yet</p>');
                            $('#approvedRequirements').html('<p class="text-center text-muted">Student hasn\'t submitted anything yet</p>');
                            $('#rejectedRequirements').html('<p class="text-center text-muted">Student hasn\'t submitted anything yet</p>');
                            return;
                        }
    
                        data.forEach(function (submission) {
                            const submissionDate = new Date(submission.submission_date);
                            const formattedDate = submissionDate.toLocaleString('en-US', {
                                month: 'short',
                                day: 'numeric',
                            });
    
                            const cardHtml = `
                                <div class="card task-card px-3 py-2 mb-4 submission-card position-relative" 
                                    data-submission-id="${submission.submit_id}">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-file-alt me-3" style="font-size: 4rem;"></i>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="card-title fs-6 mb-1">${submission.document_name}</h6>
                                            <small class="text-muted">Submitted ${formattedDate}</small>
                                            <p class="card-text mb-1"><strong>Status: ${submission.status}</strong></p>
                                        </div>
                                    </div>
                                    ${
                                        submission.status === 'pending'
                                            ? `
                                                <button class="btn btn-success btn-sm position-absolute top-0 end-0 m-2 btn-approve" 
                                                    data-id="${submission.submit_id}">Approve</button>
                                                <button class="btn btn-danger btn-sm px-3 position-absolute bottom-0 end-0 m-2 btn-reject" 
                                                    data-id="${submission.submit_id}">Reject</button>
                                            `
                                            : ''
                                    }
                                </div>`;
    
                            if (submission.status === 'pending') {
                                $('#pendingRequirements').append(cardHtml);
                            } else if (submission.status === 'approved') {
                                $('#approvedRequirements').append(cardHtml);
                            } else if (submission.status === 'rejected') {
                                $('#rejectedRequirements').append(cardHtml);
                            }
                        });
    
                        attachActionButtons();
                    } else {
                        console.error('Error: Missing status or malformed response', response);
                    }
                } catch (e) {
                    console.error('Error processing response:', e);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', status, error);
            },
        });
    }

    function attachActionButtons() {
        $('.btn-approve').off('click').on('click', function () {
            const submitId = $(this).data('id');
            updateStatus(submitId, 'approved');
        });

        $('.btn-reject').off('click').on('click', function () {
            const submitId = $(this).data('id');
            updateStatus(submitId, 'rejected');
        });
    }

    function updateStatus(submitId, status) {
        $.ajax({
            url: 'controller/requirement/update-stud-file-status.php',
            method: 'POST',
            data: { submissionId: submitId, status: status },
            success: function (response) {
                console.log('Server Response:', response);
    
                if (response.success) {
                    // Find the card for the submission
                    const card = $(`.submission-card[data-submission-id="${submitId}"]`);
    
                    // Remove the buttons (optional, since no action needed after approval/rejection)
                    card.find('.btn-approve, .btn-reject').remove();
    
                    // Move the card to the correct container
                    if (status === 'approved') {
                        $('#approvedRequirements').append(card);
                    } else if (status === 'rejected') {
                        $('#rejectedRequirements').append(card);
                    }
    
                    // Optional: Show a success message
                    console.log(`Submission ${submitId} moved to ${status} section.`);
                } else {
                    console.error('Failed to update status:', response.error);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.error('Response Text:', xhr.responseText);
            },
        });
    }
});