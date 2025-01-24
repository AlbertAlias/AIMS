$(document).ready(function () {
    function fetchRequirements() {
        $.ajax({
            url: 'controller/requirements-folder/retrieve-requirements.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    const requirements = response.data;
                    let content = '';

                    if (requirements.length > 0) {
                        content += '<ul class="list-group">';
                        requirements.forEach((req) => {
                            // Format the date to "MMM dd, yyyy"
                            const formattedDate = new Date(req.submission_date).toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'short',
                                day: 'numeric',
                            });

                            content += `
                            <div class="card mb-2" data-file-path="${req.file_path}">
                                <div class="card-body d-flex align-items-start py-2 px-2" style="margin-bottom: 0;">
                                    <span class="me-2" style="flex-shrink: 0;">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="48" height="48">
                                            <path fill="#d32923" d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-35.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z"></path>
                                        </svg>
                                    </span>
                                    <div style="flex-grow: 1;">
                                        <h5 class="card-title" style="margin-bottom: 0;">${req.document_name}</h5>
                                        <p class="card-text" style="margin-bottom: 0;">
                                            ${formattedDate}
                                        </p>
                                        <a href="${req.file_path}" target="_blank" class="btn btn-sm btn-success mt-2" style="display: none;">View Document</a>
                                    </div>
                                </div>
                            </div>
                            `;
                        });
                        content += '</ul>';
                    } else {
                        content = '<p class="text-muted">No approved requirements available.</p>';
                    }

                    $('#requirements-content').html(content);

                    // Add click event to open file in modal
                    $('.card').click(function () {
                        const filePath = $(this).data('file-path');
                        showFileInModal(filePath);
                    });
                } else {
                    $('#requirements-content').html('<p>Error fetching requirements.</p>');
                }
            },
            error: function () {
                $('#requirements-content').html('<p>An error occurred while fetching requirements.</p>');
            }
        });
    }

    // Fetch requirements on page load if "Requirements" is the active tab
    if ($('#requirements-tab').hasClass('active')) {
        fetchRequirements();
    }

    // Fetch requirements when the "Requirements" tab is shown
    $('#requirements-tab').on('shown.bs.tab', function () {
        fetchRequirements();
    });

    // Use delegated event listener to handle dynamically created close button
    $(document).on('click', '#filecloseModal', function () {
        $('#fileModal').hide(); // Hide the modal
        $('#fileViewer').attr('src', ''); // Clear the PDF viewer
        $('#fileimageViewer').attr('src', ''); // Clear the image viewer
    });
});

function showFileInModal(filePath) {
    const fileModal = document.getElementById('fileModal');
    const fileViewer = document.getElementById('fileViewer');
    const fileImageViewer = document.getElementById('fileimageViewer');

    // Clear the current source of both viewers
    fileViewer.src = '';
    fileImageViewer.src = '';

    // If file is a PDF
    if (filePath.endsWith('.pdf')) {
        // Append `#toolbar=0` to hide the toolbar
        const fileURL = `${filePath}#toolbar=0`;
        setTimeout(() => {
            fileViewer.src = fileURL; // Set the source after clearing
        }, 50); // Short delay to ensure proper reload
        fileViewer.style.display = 'block';
        fileImageViewer.style.display = 'none';
    }
    // If file is an image
    else if (['.jpg', '.jpeg', '.png'].some(ext => filePath.endsWith(ext))) {
        fileImageViewer.src = filePath; // Set the source for the image
        fileImageViewer.style.display = 'block';
        fileViewer.style.display = 'none';
    }

    // Show the modal
    fileModal.style.display = 'flex';
}