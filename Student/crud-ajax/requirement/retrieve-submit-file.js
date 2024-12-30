$(document).ready(function () {
    // Load student files
    window.loadStudentFiles = function () {
        $.ajax({
            url: 'controller/requirement/retrieve-submit-file.php',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.error) {
                    console.log(response.error);
                } else {
                    $('#taskCardContainer').empty();
                    $('.approved-file-container').empty();

                    response.forEach(function (file) {
                        const fileName = file.document_name;
                        const fileStatus = file.status;
                        const submissionDate = file.submission_date;
                        const submitId = file.submit_id;
                        const description = file.description || 'No description available';

                        let badgeClass = 'bg-warning';  // Default to bg-warning
                        if (fileStatus.toLowerCase() === 'rejected') {
                            badgeClass = 'bg-danger';  // Change to bg-danger if the status is "rejected"
                        }

                        if (fileStatus.toLowerCase() === "approved") {
                            const filePreviewHtml = `
                                <div class="file-preview">
                                    <div class="file-icon">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </div>
                                    <div class="file-details">
                                        <p class="file-name">${fileName}</p>
                                        <p class="file-date">Approved ${new Date(submissionDate).toLocaleDateString('en-US', {
                                            month: 'long', day: 'numeric'
                                        })}</p>
                                    </div>
                                    <div class="file-options">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </div>
                                </div>
                            `;
                            $('.approved-file-container').append(filePreviewHtml);
                        } else {
                            $('#taskCardContainer').show();

                            const fileCardHtml = `
                            <div class="card task-card px-3 py-1 mt-1 mb-3" style="width: 400px !important; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px; transition: transform 0.3s ease;"
                                data-file-name="${fileName}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column justify-content-center">
                                        <div class="card-title fs-6 text-success fw-bold mt-3">${fileName}</div>
                                        <p class="file-description text-muted" style="font-size: 0.835rem;">${description}</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="badge ${badgeClass} text-white py-2 px-3" style="font-size: 0.875rem; border-radius: 15px;">${fileStatus}</div>
                                        <div class="delete-icon-container" data-id="${submitId}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="delete-icon" style="width: 24px; height: 24px;">
                                                <path fill="#dc3545" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                            $('#taskCardContainer').append(fileCardHtml);
                        }
                    });

                    // Add click event for delete icons
                    $('.delete-icon').on('click', function (event) {
                        event.stopPropagation(); // Prevent the parent .task-card click event
                        const submitId = $(this).closest('.delete-icon-container').data('id');
                        deleteStudentFile(submitId);
                    });

                    // Add click event for task cards to view PDF
                    $('.task-card').on('click', function () {
                        const fileName = $(this).data('file-name');
                        const pdfViewer = document.getElementById('pdfViewer');
                        pdfViewer.src = `controller/requirement/uploads/${fileName}#toolbar=0`;

                        const modal = document.getElementById('pdfModal');
                        modal.style.display = 'flex';
                    });
                }
            },
            error: function () {
                console.log('Error fetching files');
            }
        });
    };

    function deleteStudentFile(submitId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you really want to delete this file?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'controller/requirement/delete-submit-file.php',
                    method: 'POST',
                    data: { submit_id: submitId },
                    success: function (response) {
                        console.log('Delete Response:', response);  // Log the response from the server
                        if (response.success) {
                            Swal.fire({
                                toast: true,
                                position: 'top-right',
                                icon: 'success',
                                title: 'File deleted successfully!',
                                showConfirmButton: false,
                                timer: 3000,
                                background: '#b9f6ca',
                                iconColor: '#2e7d32',
                                color: '#155724',
                                customClass: {
                                    popup: 'mt-5'
                                }
                            });
                            $(`.delete-icon[data-id="${submitId}"]`)
                                .closest('.task-card')
                                .fadeOut(300, function () {
                                    $(this).remove();
                                });

                            loadCoordinatorRequirements();
                        } else {
                            Swal.fire('Error', 'Error deleting file: ' + response.error, 'error');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log('Error details:', status, error); // Properly log the error details
                        Swal.fire('Error', 'An error occurred while trying to delete the file.', 'error');
                    }
                });
            }
        });
    }

    // Close modal logic
    $('#closeModal').on('click', function () {
        const modal = document.getElementById('pdfModal');
        modal.style.display = 'none';
        document.getElementById('pdfViewer').src = '';
    });

    $(window).on('click', function (event) {
        const modal = document.getElementById('pdfModal');
        if (event.target === modal) {
            modal.style.display = 'none';
            document.getElementById('pdfViewer').src = '';
        }
    });

    loadStudentFiles();
});
