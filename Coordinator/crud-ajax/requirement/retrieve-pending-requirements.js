$(document).ready(function () {
    // Function to fetch pending requirements when the modal is shown
    $('#pendingModal').on('show.bs.modal', function () {
        $.ajax({
            url: 'controller/requirement/students-requirements/retrieve-pending-requirements.php',
            method: 'GET',
            dataType: 'json', // Expecting JSON response
            success: function (response) {
                if (response.status === 'success') {
                    let submissions = response.data;
                    let content = '';

                    // Loop through the data and generate the HTML for each requirement
                    submissions.forEach(function (submission) {
                        let submissionDate = new Date(submission.submission_date);
                        submissionDate = submissionDate.toLocaleString(); // Format the date

                        content += `
                            <div class="card task-card px-3 py-2 mb-3 submission-card position-relative" data-submission-id="${submission.submit_id}">
                                <div class="d-flex align-items-center pt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 2.5rem; height: 2.5rem; margin-right: 5px;">
                                        <path fill="#d32923" d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-35.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z"/>
                                    </svg>
                                    <div class="d-flex flex-column justify-content-center">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="card-title mb-1 mx-1 student-name">${submission.student_name}</p>
                                            <h6 class="card-title fs-6 mb-1 document-name">${submission.document_name}</h6>
                                        </div>
                                        <small class="text-muted submission-date">Submitted ${submissionDate}</small>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-success position-absolute top-0 end-0 m-2 btn-approve" data-id="${submission.submit_id}">Approve</button>
                                <button class="btn btn-sm btn-danger px-3 position-absolute bottom-0 end-0 m-2 btn-reject" data-id="${submission.submit_id}">Reject</button>
                            </div>`;
                    });

                    $('#pendingContent').html(content);

                    // Handle approve button click
                    $('.btn-approve').on('click', function () {
                        var submitId = $(this).data('id');
                    
                        $.ajax({
                            url: 'controller/requirement/students-requirements/update-pending-requirements.php', // Path to the PHP script
                            method: 'POST',
                            data: {
                                submit_id: submitId,
                                status: 'approved'
                            },
                            success: function (response) {
                                console.log("Response from server:", response); // Log raw response
                    
                                // Check if the response is a valid JSON object
                                try {
                                    var parsedResponse = JSON.parse(response);
                                    console.log("Parsed Response:", parsedResponse); // Log parsed response
                    
                                    if (parsedResponse.status === 'success') {
                                        // Remove the submission card on success
                                        $(`.submission-card[data-submission-id="${submitId}"]`).remove();
                                    } else {
                                        console.error("Error approving:", parsedResponse.message);
                                        alert('Error approving the requirement. ' + (parsedResponse.message || 'Please try again later.'));
                                    }
                                } catch (e) {
                                    console.error('Error parsing response:', e);
                                    alert('Error in processing the response. Please try again later.');
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error('AJAX Error:', status, error);
                                alert('An error occurred while updating the status.');
                            }
                        });
                    });

                    // Handle reject button click
                    $('.btn-reject').on('click', function () {
                        var submitId = $(this).data('id');
                    
                        $.ajax({
                            url: 'controller/requirement/students-requirements/update-pending-requirements.php',
                            method: 'POST',
                            data: {
                                submit_id: submitId,
                                status: 'rejected'
                            },
                            success: function (response) {
                                console.log("Response from server:", response); // Log raw response
                    
                                // Check if the response is a valid JSON object
                                try {
                                    var parsedResponse = JSON.parse(response);
                                    console.log("Parsed Response:", parsedResponse); // Log parsed response
                    
                                    if (parsedResponse.status === 'success') {
                                        $(`.submission-card[data-submission-id="${submitId}"]`).remove();
                                    } else {
                                        alert('Error rejecting the requirement. ' + (parsedResponse.message || 'Please try again later.'));
                                    }
                                } catch (e) {
                                    console.error('Error parsing response:', e);
                                    alert('Error in processing the response. Please try again later.');
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error('AJAX Error:', status, error);
                                alert('An error occurred while rejecting the requirement.');
                            }
                        });
                    });
                } else {
                    $('#pendingContent').html('<p>No pending requirements found.</p>');
                }
            },
            error: function () {
                $('#pendingContent').html('<p>An error occurred. Please try again later.</p>');
            }
        });
    });
});