$(document).ready(function () {
    let isFileOpen = false;

    // Fetch requirements titles and populate dropdown
    function fetchRequirements() {
        $.ajax({
            url: 'controller/requirement/students-requirements/retrieve-requirements-title.php',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    let requirements = response.data;
                    let options = '<option value="" selected>All Requirements</option>';
            
                    requirements.forEach(function (requirement) {
                        options += `<option value="${requirement.requirement_id}">${requirement.title}</option>`;
                    });
            
                    $('#rejectedSelectOption').html(options);
                } else {
                    $('#rejectedSelectOption').html('<option disabled>No open requirements found.</option>');
                }
            },
            error: function () {
                $('#rejectedSelectOption').html('<option disabled>Error fetching requirements.</option>');
            }
        });
    }

    // Fetch rejected requirements based on selected requirement or search term
    function fetchRejectedRequirements(searchTerm = '', requirementId = '') {
        $.ajax({
            url: 'controller/requirement/students-requirements/retrieve-rejected-requirements.php',
            method: 'GET',
            data: {
                search_term: searchTerm, // Pass the search term for student_name filtering
                requirement_id: requirementId // Filter by selected requirement
            },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    let submissions = response.data;
                    let content = '';
                    submissions.forEach(function (submission) {
                        let submissionDate = new Date(submission.submission_date);
                        submissionDate = submissionDate.toLocaleString(); // Format the date

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
                                    <small class="text-muted submission-date">Submitted ${submissionDate}</small>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-success position-absolute top-0 end-0 mt-4 m-2 btn-approve" data-id="${submission.submit_id}">Approve</button>
                            <button class="btn btn-sm btn-primary position-absolute bottom-0 start-0 m-2 btn-view-file" data-file-path="${submission.file_path}" style="display: none;">View File</button>
                        </div>
                        `;
                    });
                    $('#rejectedContent').html(content);
                } else {
                    $('#rejectedContent').html('<p>No rejected requirements found.</p>');
                }
            },
            error: function () {
                $('#rejectedContent').html('<p>An error occurred. Please try again later.</p>');
            }
        });
    }

    // Open PDF modal function
    function openPDFModal(filePath) {
        const pdfViewer = document.getElementById('pdfViewer');
        const modal = document.getElementById('pdfModal');

        pdfViewer.src = '';
        setTimeout(() => {
            pdfViewer.src = `${filePath}#toolbar=0`;
        }, 50);

        modal.style.display = 'flex';
    }

    // Close the modal when the close button is clicked
    document.getElementById('closeModal').addEventListener('click', function () {
        const modal = document.getElementById('pdfModal');
        const pdfViewer = document.getElementById('pdfViewer');
        modal.style.display = 'none';
        pdfViewer.src = '';
    });

    // Close the modal when clicking outside the modal content
    window.addEventListener('click', function (event) {
        const modal = document.getElementById('pdfModal');
        if (event.target === modal) {
            modal.style.display = 'none';
            document.getElementById('pdfViewer').src = '';
        }
    });

    // Function to fetch rejected requirements and requirement titles when the modal is shown
    $('#rejectedModal').on('show.bs.modal', function () {
        fetchRequirements();
        fetchRejectedRequirements();
    });

    // Listen for changes on the requirement filter
    $('#rejectedSelectOption').on('change', function () {
        const selectedRequirement = $(this).val();
        const searchTerm = $('#rejectedSearchInput').val().trim(); // Get the current search term
        fetchRejectedRequirements(searchTerm, selectedRequirement);
    });

    // Listen for changes in the search input
    $('#rejectedSearchInput').on('input', function () {
        const searchTerm = $(this).val().trim();
        const selectedRequirement = $('#rejectedSelectOption').val(); // Get selected requirement
        fetchRejectedRequirements(searchTerm, selectedRequirement);
    });

    // Handle submission card click for "View File"
    $(document).on('click', '.submission-card', function () {
        var viewFileButton = $(this).find('.btn-view-file');
        if (viewFileButton.length && !isFileOpen) {
            isFileOpen = true;
            const filePath = viewFileButton.data('file-path');
            openPDFModal(filePath); // Open the PDF modal with the file

            setTimeout(() => {
                isFileOpen = false;
            }, 200);
        }
    });

    // Handle approve button click
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
                console.log("Response from server:", response);
                try {
                    var parsedResponse = typeof response === 'string' ? JSON.parse(response) : response;
                    if (parsedResponse.status === 'success') {
                        $(`.submission-card[data-submission-id="${submitId}"]`).remove();
                    } else {
                        alert(parsedResponse.message || 'Error approving requirement.');
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                }
            },
            error: function () {
                alert('An error occurred while approving this requirement.');
            }
        });
    });
});
