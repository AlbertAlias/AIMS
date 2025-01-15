$(document).ready(function () {
    let isFileOpen = false;

    function fetchRequirements() {
        $.ajax({
            url: 'controller/requirement/students-requirements/retrieve-requirements-title.php',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                let options = '';
                if (response.status === 'success' && response.data.length > 0) {
                    options += '<option value="" selected>All Requirements</option>';
                    response.data.forEach(function (requirement) {
                        options += `<option value="${requirement.requirement_id}">${requirement.title}</option>`;
                    });
                } else {
                    // If no requirements, show a placeholder option
                    options = '<option value="" disabled selected>No requirements available</option>';
                }
                $('#pendingSelectOption').html(options);
            },
            error: function () {
                // In case of an error fetching requirements
                $('#pendingSelectOption').html('<option value="" disabled selected>Error fetching requirements</option>');
            }
        });
    }

    function formatSubmissionDate(submissionDate) {
        const date = new Date(submissionDate);
        const now = new Date();
        const isSameYear = date.getFullYear() === now.getFullYear();
        
        const options = {
            month: 'short',
            day: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            hour12: true
        };
        
        let formattedDate = date.toLocaleString('en-US', options);
        
        if (!isSameYear) {
            formattedDate = `${formattedDate}, ${date.getFullYear()}`;
        }

        return formattedDate;
    }

    function fetchPendingRequirements(searchTerm = '', requirementId = '') {
        $.ajax({
            url: 'controller/requirement/students-requirements/retrieve-pending-requirements.php',
            method: 'GET',
            data: {
                search_term: searchTerm,
                requirement_id: requirementId
            },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    let submissions = response.data;
                    let content = '';
                    submissions.forEach(function (submission) {
                        let submissionDate = formatSubmissionDate(submission.submission_date);

                        content += `
                        <div class="card task-card px-3 py-2 mb-3 submission-card position-relative" data-submission-id="${submission.submit_id}">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 3rem; height: 3rem; margin-right: 5px;">
                                    <path fill="#d32923" d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-35.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z"/>
                                </svg>
                                <div class="d-flex flex-column justify-content-center mt-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="card-title mb-1 student-name">${submission.student_name}</p>
                                        <h6 class="card-title fs-6 mb-1 mx-1 document-name">${submission.document_name}</h6>
                                        <p class="card-text mb-1">is ${submission.status}</p>
                                    </div>
                                    <small class="text-muted submission-date">${submissionDate}</small>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-success position-absolute top-0 end-0 m-2 btn-approve" data-id="${submission.submit_id}">Approve</button>
                            <button class="btn btn-sm btn-danger px-3 position-absolute bottom-0 end-0 m-2 btn-reject" data-id="${submission.submit_id}">Reject</button>
                            <button class="btn btn-sm btn-primary position-absolute bottom-0 start-0 m-2 btn-view-file" data-file-path="${submission.file_path}" style="display: none;">View File</button>
                        </div>
                        `;
                    });
                    $('#pendingContent').html(content);
                } else {
                    $('#pendingContent').html('<p>No pending requirements found.</p>');
                }
            },
            error: function () {
                $('#pendingContent').html('<p>An error occurred. Please try again later.</p>');
            }
        });
    }

    function openPDFModal(filePath) {
        const pdfViewer = document.getElementById('pdfViewer');
        const modal = document.getElementById('pdfModal');
        
        pdfViewer.src = `${filePath}#toolbar=0`;
        modal.style.display = 'flex';
    }

    document.getElementById('closeModal').addEventListener('click', function () {
        const modal = document.getElementById('pdfModal');
        const pdfViewer = document.getElementById('pdfViewer');
        modal.style.display = 'none';
        pdfViewer.src = '';
    });

    window.addEventListener('click', function (event) {
        const modal = document.getElementById('pdfModal');
        if (event.target === modal) {
            modal.style.display = 'none';
            document.getElementById('pdfViewer').src = '';
        }
    });

    $('#pendingModal').on('show.bs.modal', function () {
        fetchRequirements();
        fetchPendingRequirements();
    });

    $('#pendingSelectOption').on('change', function () {
        const selectedRequirement = $(this).val();
        const searchTerm = $('#pendingSearchInput').val().trim();
        fetchPendingRequirements(searchTerm, selectedRequirement);
    });

    $('#pendingSearchInput').on('input', function () {
        const searchTerm = $(this).val().trim();
        const selectedRequirement = $('#pendingSelectOption').val();
        fetchPendingRequirements(searchTerm, selectedRequirement);
    });

    $(document).on('click', '.submission-card', function () {
        var viewFileButton = $(this).find('.btn-view-file');
        if (viewFileButton.length && !isFileOpen) {
            isFileOpen = true;
            const filePath = viewFileButton.data('file-path');
            openPDFModal(filePath);

            setTimeout(() => {
                isFileOpen = false;
            }, 200);
        }
    });

    $(document).on('click', '.btn-approve', function (event) {
        event.stopPropagation();
        var submitId = $(this).data('id');
    
        $.ajax({
            url: 'controller/requirement/students-requirements/update-requirements-status.php',
            method: 'POST',
            data: {
                submit_id: submitId,
                status: 'approved'
            },
            success: function (response) {
                try {
                    var parsedResponse = typeof response === 'string' ? JSON.parse(response) : response;
            
                    if (parsedResponse.status === 'success') {
                        $(`.submission-card[data-submission-id="${submitId}"]`).remove();

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Requirement Approved',
                            showConfirmButton: false,
                            timer: 3000,
                            background: '#b9f6ca',
                            iconColor: '#2e7d32',
                            color: '#155724',
                            customClass: {
                                popup: 'mt-5'
                            }
                        });
                    } else {
                        alert(parsedResponse.message || 'Failed to process the approval.');
                    }
                } catch (e) {
                    console.error('Error parsing server response:', e, response);
                    alert('Unexpected error occurred. Check the console for details.');
                }
            },
            error: function () {
                alert('An error occurred while approving this requirement.');
            }
        });
    });

    $(document).on('click', '.btn-reject', function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        
        var submitId = $(this).data('id');
        
        $('#submitRemarksBtn').data('submit-id', submitId);
        $('#remarksModal').modal('show');
    });

    $('#submitRemarksBtn').on('click', function () {
        var submitId = $(this).data('submit-id');
        var remarks = $('#remarksTextarea').val();

        $.ajax({
            url: 'controller/requirement/students-requirements/update-requirements-status.php',
            method: 'POST',
            data: {
                submit_id: submitId,
                status: 'rejected',
                remarks: remarks
            },
            success: function (response) {
                var parsedResponse = typeof response === 'string' ? JSON.parse(response) : response;
                
                if (parsedResponse.status === 'success') {
                    $(`.submission-card[data-submission-id="${submitId}"]`).remove();
                    $('#remarksTextarea').val('');
                    $('#remarksModal').modal('hide');

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Requirement Rejected',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                } else {
                    alert(parsedResponse.message || 'Failed to reject the requirement.');
                }
            },
            error: function () {
                alert('An error occurred while rejecting the requirement.');
            }
        });
    });
});