$(document).ready(function () {
    // Flag to ensure the button is only triggered once
    let isFileOpen = false;

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
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 4rem; height: 4rem; margin-right: 5px;">
                                    <path fill="#d32923" d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-35.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z"/>
                                </svg>
                                <div class="d-flex flex-column justify-content-center">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="card-title mb-1 student-name">${submission.student_name}</p>
                                        <h6 class="card-title fs-6 mb-1 mx-1 document-name">${submission.document_name}</h6>
                                        <p class="card-text mb-1">is ${submission.status}</p>
                                    </div>
                                    <small class="text-muted submission-date">Submitted ${submissionDate}</small>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-success position-absolute top-0 end-0 m-2 btn-approve" data-id="${submission.submit_id}">Approve</button>
                            <button class="btn btn-sm btn-danger px-3 position-absolute bottom-0 end-0 m-2 btn-reject" data-id="${submission.submit_id}">Reject</button>
                            <button class="btn btn-sm btn-primary position-absolute bottom-0 start-0 m-2 btn-view-file" data-file-path="${submission.file_path}" style="display: none;">View File</button>
                        </div>
                        `;
                    });

                    $('#pendingContent').html(content);

                    // Handle submission card click for "View File"
                    $(document).on('click', '.submission-card', function () {
                        var viewFileButton = $(this).find('.btn-view-file'); // Find the View File button inside the clicked card
                        if (viewFileButton.length && !isFileOpen) {
                            // Prevent multiple clicks while file is being opened
                            isFileOpen = true;
                            const filePath = viewFileButton.data('file-path');
                            openPDFModal(filePath); // Open the PDF modal with the file

                            // Reset flag after a short delay
                            setTimeout(() => {
                                isFileOpen = false;
                            }, 500);  // Adjust this delay as necessary
                        }
                    });

                    // Handle approve button click
                    $(document).on('click', '.btn-approve', function (event) {
                        event.stopPropagation(); // Prevent click event from bubbling up to .submission-card
                        var submitId = $(this).data('id');
                    
                        $.ajax({
                            url: 'controller/requirement/students-requirements/update-pending-requirements.php',
                            method: 'POST',
                            data: {
                                submit_id: submitId,
                                status: 'approved'
                            },
                            success: function (response) {
                                console.log("Response from server:", response); // Log raw response
                                try {
                                    var parsedResponse = typeof response === 'string' ? JSON.parse(response) : response;
                                    if (parsedResponse.status === 'success') {
                                        $(`.submission-card[data-submission-id="${submitId}"]`).remove(); // Remove card from UI
                                    } else {
                                        alert(parsedResponse.message || 'Error approving the requirement. Please try again later.');
                                    }
                                } catch (e) {
                                    console.error('Error parsing response:', e);
                                    alert('Unexpected response format. Please try again later.');
                                }
                            },
                            error: function () {
                                alert('An error occurred while updating the status.');
                            }
                        });
                    });
                    
                    // Handle reject button click
                    $(document).on('click', '.btn-reject', function (event) {
                        event.stopPropagation();
                        const submissionId = $(this).data('id');
                        const submissionCard = $(this).closest('.submission-card');
                    
                        $('#remarksModal').modal('show');
                        $('#remarksTextarea').val('');

                        $('#submitRemarksBtn').off('click').on('click', function () {
                            const remarks = $('#remarksTextarea').val().trim();

                            if (remarks === '') {
                                alert('Please provide remarks before rejecting.');
                                return;
                            }

                            $.ajax({
                                url: 'controller/requirement/students-requirements/update-pending-requirements.php',
                                method: 'POST',
                                data: {
                                    submit_id: submissionId,
                                    status: 'rejected',
                                    remarks: remarks
                                },
                                success: function (response) {
                                    try {
                                        const parsedResponse = JSON.parse(response);
                                        if (parsedResponse.status === 'success') {
                                            $('#rejectedContent').append(submissionCard);
                                            submissionCard.find('.btn-reject').remove();
                                            submissionCard.find('.btn-approve').remove();
                                            $('#remarksModal').modal('hide');
                                        } else {
                                            alert('Error rejecting submission.');
                                        }
                                    } catch (e) {
                                        console.error('Error parsing response:', e);
                                        alert('Error processing the server response.');
                                    }
                                },
                                error: function () {
                                    alert('An error occurred while rejecting the requirement.');
                                }
                            });
                        });
                    });

                    // Handle View File button click
                    $(document).on('click', '.btn-view-file', function () {
                        const filePath = $(this).data('file-path');
                        openPDFModal(filePath); // Open the PDF modal with the file
                    });

                    // Open PDF modal function
                    function openPDFModal(filePath) {
                        const pdfViewer = document.getElementById('pdfViewer');
                        const modal = document.getElementById('pdfModal');

                        // Reassign the src to ensure the PDF reloads
                        pdfViewer.src = ''; // Clear first to force reload
                        setTimeout(() => {
                            pdfViewer.src = `${filePath}#toolbar=0`; // Add `#toolbar=0` to hide the toolbar
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