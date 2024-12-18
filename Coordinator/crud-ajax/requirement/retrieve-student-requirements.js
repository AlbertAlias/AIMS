$(document).ready(function () {
    // Event listener for clicks on the card to trigger the "View File" button
    $(document).on('click', '.submission-card', function (event) {
        // Check if the target is not an "Approve" or "Reject" button
        if (!$(event.target).closest('.btn-approve').length && !$(event.target).closest('.btn-reject').length) {
            const filePath = $(this).find('.btn-view-file').data('file-path');
            openPDFModal(filePath);
        }
    });

    $(document).on('click', '.btn-approve', function (event) {
        event.stopPropagation();  // Prevent the click from bubbling up to the card
        const submissionId = $(this).data('id');
        const submissionCard = $(this).closest('.submission-card'); // Get the card where this button was clicked
        
        // Extract data from the card using the correct selectors
        const submissionData = {
            submit_id: submissionId,
            student_name: submissionCard.find('.student-name').text().trim(), // Get student name
            document_name: submissionCard.find('.document-name').text().trim(), // Get document name
            submission_date: submissionCard.find('.submission-date').text().replace('Submitted ', '').trim() // Get submission date
        };
        
        console.log(submissionData); // Check the extracted data
    
        // Send AJAX request to update the status in the database
        $.ajax({
            url: 'controller/requirement/update-requirement-status.php',
            method: 'POST',
            data: {
                submit_id: submissionId,
                status: 'approved'
            },
            success: function (response) {
                try {
                    if (typeof response === 'string') {
                        response = JSON.parse(response);
                    }
    
                    if (response.status === 'success') {
                        // On success, remove the item from the pending list
                        submissionCard.remove();
    
                        // Store the approved submission data in localStorage
                        let approvedSubmissions = JSON.parse(localStorage.getItem('approvedSubmissions')) || [];
                        approvedSubmissions.push(submissionData);
                        localStorage.setItem('approvedSubmissions', JSON.stringify(approvedSubmissions));

                        // Append the approved requirement to the completed content
                        const approvedRequirement = `
                            <div class="card task-card px-3 py-2 mb-3 submission-card position-relative" data-submission-id="${submissionId}" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-file-pdf me-2" style="font-size: 4rem; color: #d32923;"></i>
                                    <div class="d-flex flex-column justify-content-center">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="card-title fs-6 mb-1" style="color: #555;">${submissionData.document_name}</h6>
                                            <p class="card-title mb-1" style="color: #333;">of ${submissionData.student_name} has been</p>
                                            <p class="card-text mb-1 mx-1">approved</p>
                                        </div>
                                        <small class="text-muted">Submitted ${submissionData.submission_date}</small>
                                    </div>
                                </div>
                                <button class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 btn-delete-file" data-id="${submissionId}" style="border-radius: 5px;">Delete File</button>
                            </div>
                        `;
                        $('#completedContent').append(approvedRequirement); // Append to completed content
                    } else {
                        console.error('Error: Failed to approve the submission');
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', status, error);
            }
        });
    });

    // Event listener for "Reject" button click
    $(document).on('click', '.btn-reject', function (event) {
        event.stopPropagation();
        const submissionId = $(this).data('id');
        const submissionCard = $(this).closest('.submission-card');
    
        // Show modal for remarks input
        $('#remarksModal').modal('show');
    
        // Clear previous remarks
        $('#remarksTextarea').val('');
    
        // Handle submit button click inside the modal
        $('#submitRemarksBtn').off('click').on('click', function () {
            const remarks = $('#remarksTextarea').val().trim();
    
            if (remarks === '') {
                alert('Please provide remarks before rejecting.');
                return;
            }
    
            // Send AJAX request to reject with remarks
            $.ajax({
                url: 'controller/requirement/update-requirement-status.php',
                method: 'POST',
                data: {
                    submit_id: submissionId,
                    status: 'rejected',
                    remarks: remarks
                },
                success: function (response) {
                    try {
                        response = JSON.parse(response);
                        if (response.status === 'success') {
                            // Move the rejected card to the rejected content section
                            $('#rejectedContent').append(submissionCard); // Append to rejected section
                            submissionCard.find('.btn-reject').remove(); // Remove reject button
                            submissionCard.find('.btn-approve').remove(); // Remove approve button
                            $('#remarksModal').modal('hide');
                            console.log('Submission rejected successfully.');
                        } else {
                            alert(response.message || 'Error rejecting submission.');
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX error:', status, error);
                }
            });
        });
    });
    

    // Event listener for "Delete File" button click
    $(document).on('click', '.btn-delete-file', function (event) {
        const submissionId = $(this).data('id');
        const submissionCard = $(this).closest('.submission-card');

        // Send AJAX request to delete the file from the database
        $.ajax({
            url: 'controller/requirement/delete-student-requirements.php',
            method: 'POST',
            data: { submit_id: submissionId },
            success: function (response) {
                try {
                    if (typeof response === 'string') {
                        response = JSON.parse(response);
                    }
        
                    if (response.status === 'success') {
                        // Remove the file from both the frontend and localStorage
                        submissionCard.remove();
                        
                        let approvedSubmissions = JSON.parse(localStorage.getItem('approvedSubmissions')) || [];
                        approvedSubmissions = approvedSubmissions.filter(submission => submission.submit_id !== submissionId);
                        localStorage.setItem('approvedSubmissions', JSON.stringify(approvedSubmissions));
        
                        console.log('File deleted and removed from view.');
                    } else {
                        console.error('Error: Failed to delete the file');
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', status, error);
            }
        });
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

    function loadRequirementTitles() {
        $.ajax({
            url: 'controller/requirement/retrieve-requirements-title.php', // New PHP file to fetch titles
            method: 'GET',
            success: function (response) {
                try {
                    if (typeof response === 'string') {
                        response = JSON.parse(response);
                    }

                    if (response.status === 'success') {
                        // Get the titles from the response
                        const titles = response.titles;

                        // Clear existing options
                        $('#pendingSelectOption').empty();
                        $('#rejectedSelectOption').empty();
                        $('#completedSelectOption').empty();

                        // Add default "All" option
                        const defaultOption = '<option selected value="">All</option>';
                        $('#pendingSelectOption').append(defaultOption);
                        $('#rejectedSelectOption').append(defaultOption);
                        $('#completedSelectOption').append(defaultOption);

                        // Populate select options with titles
                        titles.forEach(function (title) {
                            const optionHtml = `<option value="${title}">${title}</option>`;
                            $('#pendingSelectOption').append(optionHtml);
                            $('#rejectedSelectOption').append(optionHtml);
                            $('#completedSelectOption').append(optionHtml);
                        });
                    } else {
                        console.error('Error fetching titles:', response.message);
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', status, error);
            }
        });
    }

    // Load requirement titles when the modal is opened
    $('#pendingModal').on('show.bs.modal', function () {
        loadRequirementTitles(); // Populate select options on modal open
        loadPendingRequirements(); // Existing function to load pending requirements
    });

    $('#rejectedModal').on('show.bs.modal', function () {
        loadRequirementTitles(); // Populate select options on modal open
        loadRejectedRequirements(); // Function to load rejected requirements
    });

    $('#completedModal').on('show.bs.modal', function () {
        loadRequirementTitles(); // Populate select options on modal open
        loadCompletedRequirements(); // Function to load completed requirements
    });

    // Handle filter change for pending
    $('#pendingSelectOption').change(function () {
        const selectedTitle = $(this).val();
        if (selectedTitle === '' || selectedTitle === 'All') {
            loadPendingRequirements(); // No filter, load all
        } else {
            loadPendingRequirements(selectedTitle); // Load filtered pending requirements
        }
    });

    // Handle filter change for rejected
    $('#rejectedSelectOption').change(function () {
        const selectedTitle = $(this).val();
        if (selectedTitle === '' || selectedTitle === 'All') {
            loadRejectedRequirements(); // No filter, load all rejected
        } else {
            loadRejectedRequirements(selectedTitle); // Load filtered rejected requirements
        }
    });

    // Handle filter change for completed
    $('#completedSelectOption').change(function () {
        const selectedTitle = $(this).val();
        if (selectedTitle === '' || selectedTitle === 'All') {
            loadCompletedRequirements(); // No filter, load all completed
        } else {
            loadCompletedRequirements(selectedTitle); // Load filtered completed requirements
        }
    });

    // Function to load pending student requirements
    function loadPendingRequirements(titleFilter = '') {
        $.ajax({
            url: 'controller/requirement/retrieve-student-requirements.php',
            method: 'POST',
            data: { title: titleFilter, status: 'pending' }, // Filter by status 'pending'
            success: function (response) {
                renderRequirements(response, '#pendingContent');
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', status, error);
                $('#pendingContent').html('<p class="text-center text-danger">Failed to load pending requirements.</p>');
            }
        });
    }

    // Function to load rejected student requirements
    function loadRejectedRequirements(titleFilter = '') {
        $.ajax({
            url: 'controller/requirement/retrieve-student-requirements.php',
            method: 'POST',
            data: { title: titleFilter, status: 'rejected' }, // Filter by status 'rejected'
            success: function (response) {
                renderRequirements(response, '#rejectedContent');
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', status, error);
                $('#rejectedContent').html('<p class="text-center text-danger">Failed to load rejected requirements.</p>');
            }
        });
    }

    // Function to load completed student requirements
    function loadCompletedRequirements(titleFilter = '') {
        $.ajax({
            url: 'controller/requirement/retrieve-student-requirements.php',
            method: 'POST',
            data: { title: titleFilter, status: 'approved' }, // Filter by status 'approved'
            success: function (response) {
                renderRequirements(response, '#completedContent');
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', status, error);
                $('#completedContent').html('<p class="text-center text-danger">Failed to load completed requirements.</p>');
            }
        });
    }

    // Helper function to render requirements on the page
    function renderRequirements(response, container) {
        try {
            if (typeof response === 'string') {
                response = JSON.parse(response);
            }

            $(container).empty();

            if (response.status === 'success') {
                const data = response.data;

                if (data.length === 0) {
                    $(container).html('<p class="text-center text-muted">No requirements found.</p>');
                    return;
                }

                data.forEach(function (submission) {
                    const submissionDate = new Date(submission.submission_date).toLocaleString('en-US', {
                        month: 'short',
                        day: 'numeric',
                    });

                    const cardHtml = `
                        <div class="card task-card px-3 py-2 mb-3 submission-card position-relative" data-submission-id="${submission.submit_id}">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-file-pdf me-2" style="font-size: 4rem; color: #d32923;"></i>
                                <div class="d-flex flex-column justify-content-center">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="card-title mb-1 student-name">${submission.student_name} has</p>
                                        <p class="card-text mb-1 mx-1">${submission.status}</p>
                                        <h6 class="card-title fs-6 mb-1 document-name">${submission.document_name}</h6>
                                    </div>
                                    <small class="text-muted submission-date">Submitted ${submissionDate}</small>
                                </div>
                            </div>
                            <button class="btn btn-success btn-sm position-absolute top-0 end-0 m-2 btn-approve" data-id="${submission.submit_id}">Approve</button>
                            <button class="btn btn-danger btn-sm px-3 position-absolute bottom-0 end-0 m-2 btn-reject" data-id="${submission.submit_id}">Reject</button>
                            <button class="btn btn-primary btn-sm position-absolute bottom-0 start-0 m-2 btn-view-file" data-file-path="${submission.file_path}" style="display: none;">View File</button>
                        </div>
                    `;
                    $(container).append(cardHtml);
                });

            } else {
                console.error('Error: Invalid response', response);
                $(container).html('<p class="text-center text-danger">Error fetching requirements.</p>');
            }
        } catch (e) {
            console.error('Error parsing response:', e);
        }
    }

    // Load approved submissions on page load
    function loadApprovedSubmissions() {
        $.ajax({
            url: 'controller/requirement/retrieve-approved-requirements.php',
            method: 'GET',
            success: function (response) {
                try {
                    if (typeof response === 'string') {
                        response = JSON.parse(response);
                    }

                    $('#completedContent').empty();

                    if (response.status === 'success') {
                        const data = response.data;

                        if (data.length === 0) {
                            $('#completedContent').html('<p class="text-center text-muted">No approved requirements found.</p>');
                            return;
                        }

                        data.forEach(function (submission) {
                            const submissionDate = new Date(submission.submission_date).toLocaleString('en-US', {
                                month: 'short',
                                day: 'numeric',
                            });

                            const cardHtml = `
                                <div class="card task-card px-3 py-2 mb-3 submission-card position-relative" data-submission-id="${submission.submit_id}">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-file-pdf me-2" style="font-size: 4rem; color: #d32923;"></i>
                                        <div class="d-flex flex-column justify-content-center">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="card-title mb-1 student-name">${submission.student_name} has</p>
                                                <p class="card-text mb-1 mx-1">${submission.status}</p>
                                                <h6 class="card-title fs-6 mb-1 document-name">${submission.document_name}</h6>
                                            </div>
                                            <small class="text-muted submission-date">Submitted ${submissionDate}</small>
                                        </div>
                                    </div>
                                </div>
                            `;
                            $('#completedContent').append(cardHtml);
                        });
                    } else {
                        console.error('Error fetching approved submissions:', response.message);
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', status, error);
            }
        });
    }
});