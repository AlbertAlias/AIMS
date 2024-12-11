$(document).ready(function () {
    // Function to load the student's file submission
    function loadStudentFile() {
        $.ajax({
            url: 'controller/requirement/retrieve-submit-file.php',  // The PHP script to fetch the file
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    console.log(response.error);
                } else {
                    const fileName = response.document_name;
                    const fileStatus = response.status;
                    const submissionDate = response.submission_date;

                    if (fileStatus.toLowerCase() === "approved") {
                        // Hide taskCardContainer if status is approved
                        $('#taskCardContainer').hide().empty();

                        // Populate the file-preview section
                        $('.file-name').text(fileName);
                        $('.file-date').text(`Submitted on: ${new Date(submissionDate).toLocaleDateString('en-US', {
                            year: 'numeric', month: 'long', day: 'numeric'
                        })}`);
                    } else {
                        // Show the taskCardContainer for non-approved files
                        $('#taskCardContainer').show();

                        const fileCardHtml = `
                            <div class="card task-card px-3 py-3 mt-1" 
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
                        $('#taskCardContainer').html(fileCardHtml);
                    }
                }
            },
            error: function() {
                console.log('Error fetching file');
            }
        });
    }

    // Load the student's file when the page is ready
    loadStudentFile();
});