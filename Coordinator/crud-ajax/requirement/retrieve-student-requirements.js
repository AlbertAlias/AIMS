$(document).ready(function () {
    // Event listener for clicks on the card (instead of "View File" button)
    document.addEventListener('click', function (event) {
        const card = event.target.closest('.submission-card');
        if (card) {
            const filePath = card.querySelector('.btn-view-file').getAttribute('data-file-path');
            openPDFModal(filePath);
        }
    });

    // Function to open the PDF modal
    function openPDFModal(filePath) {
        const pdfViewer = document.getElementById('pdfViewer');
        const modal = document.getElementById('pdfModal');
        
        // Reassign the src to ensure the PDF reloads
        pdfViewer.src = ''; // Clear first to force reload
        setTimeout(() => {
            pdfViewer.src = `${filePath}#toolbar=0`;
        }, 50); // Small delay to allow the browser to reset the src
        
        modal.style.display = 'flex'; // Show the modal
    }

    // Close the modal when the close button is clicked
    document.getElementById('closeModal').addEventListener('click', function () {
        const modal = document.getElementById('pdfModal');
        const pdfViewer = document.getElementById('pdfViewer');
        modal.style.display = 'none';
        pdfViewer.src = ''; // Clear the PDF source when modal is closed
    });

    // Close the modal when clicking outside the modal content
    window.addEventListener('click', function (event) {
        const modal = document.getElementById('pdfModal');
        if (event.target === modal) {
            modal.style.display = 'none';
            document.getElementById('pdfViewer').src = '';
        }
    });
    
    $('#pendingModal').on('show.bs.modal', function () {
        loadPendingRequirements();
    });

    // Function to load pending student requirements
    function loadPendingRequirements() {
        $.ajax({
            url: 'controller/requirement/retrieve-student-requirements.php',
            method: 'POST',
            success: function (response) {
                try {
                    if (typeof response === 'string') {
                        response = JSON.parse(response);
                    }
    
                    $('#pendingContent').empty();
    
                    if (response.status === 'success') {
                        const data = response.data;
    
                        if (data.length === 0) {
                            $('#pendingContent').html('<p class="text-center text-muted">No pending requirements found.</p>');
                            return;
                        }
    
                        data.forEach(function (submission) {
                            const submissionDate = new Date(submission.submission_date).toLocaleString('en-US', {
                                month: 'short',
                                day: 'numeric',
                            });
                        
                            const cardHtml = `
                                <div class="card task-card px-3 py-2 mb-3 submission-card position-relative" data-submission-id="${submission.submit_id}" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-file-pdf me-2" style="font-size: 4rem; color: #d32923;"></i>
                                        <div class="d-flex flex-column justify-content-center">
                                            <div class="d-flex justify-content-between align-items-center">
                                            <p class="card-title mb-1" style= color: #333;">${submission.student_name} has</p>
                                            <p class="card-text mb-1 mx-1">${submission.status}</p>
                                            <h6 class="card-title fs-6 mb-1" style="color: #555;">${submission.document_name}</h6>
                                            </div>
                                            <small class="text-muted">Submitted ${submissionDate}</small>
                                        </div>
                                    </div>
                                    <button class="btn btn-success btn-sm position-absolute top-0 end-0 m-2 btn-approve" data-id="${submission.submit_id}" style="border-radius: 5px;">Approve</button>
                                    <button class="btn btn-danger btn-sm px-3 position-absolute bottom-0 end-0 m-2 btn-reject" data-id="${submission.submit_id}" style="border-radius: 5px;">Reject</button>
                                    <button class="btn btn-primary btn-sm position-absolute bottom-0 start-0 m-2 btn-view-file" data-file-path="${submission.file_path}" style="border-radius: 5px; display: none;">View File</button>
                                </div>
                                `;
                            $('#pendingContent').append(cardHtml);
                        });
    
                    } else {
                        console.error('Error: Invalid response', response);
                        $('#pendingContent').html('<p class="text-center text-danger">Error fetching pending requirements.</p>');
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', status, error);
                $('#pendingContent').html('<p class="text-center text-danger">Failed to load pending requirements.</p>');
            }
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