$(document).ready(function () {
    // Function to load the student's file submissions
    window.loadStudentFiles = function() {
        $.ajax({
            url: 'controller/requirement/retrieve-submit-file.php', // The PHP script to fetch the files
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.error) {
                    console.log(response.error);
                } else {
                    $('#taskCardContainer').empty(); // Clear the container before appending new files
                    $('.approved-file-container').empty(); // Clear the approved file container

                    response.forEach(function (file) {
                        const fileName = file.document_name;
                        const fileStatus = file.status;
                        const submissionDate = file.submission_date;

                        if (fileStatus.toLowerCase() === "approved") {
                            // Dynamically create and append the file preview HTML for approved files
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
                            // Show the taskCardContainer for non-approved files
                            $('#taskCardContainer').show();

                            const fileCardHtml = `
                                <div class="card task-card px-3 py-3 mt-1 mb-3" 
                                    style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px; transition: transform 0.3s ease;">
                                    <div class="d-flex justify-content-between align-items-center" style="height: 100%;">
                                        <div class="d-flex align-items-center">
                                            <div class="card-title fs-6 text-success fw-bold mt-2">${fileName}</div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="badge bg-warning text-white py-2 px-3" style="font-size: 0.875rem; border-radius: 15px;">${fileStatus}</div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            $('#taskCardContainer').append(fileCardHtml);
                        }
                    });
                }
            },
            error: function () {
                console.log('Error fetching files');
            }
        });
    }

    // Load the student's files when the page is ready
    loadStudentFiles();
});
