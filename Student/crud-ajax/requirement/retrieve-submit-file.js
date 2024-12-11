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
                    // If a file is submitted, display it in the task card
                    $('#taskCardContainer').show();  // Show the task card container
                    const fileName = response.document_name;
                    const fileStatus = response.status;

                    // Apply the same card styling as in retrieve-requirements.js
                    const fileCardHtml = `
                        <div class="card task-card px-3 py-3 mt-1" 
                            style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px; transition: transform 0.3s ease;">
                            <div class="d-flex justify-content-between align-items-center" style="height: 100%;">
                                <div class="d-flex align-items-center">
                                    <div class="card-title fs-6 text-primary fw-bold">${fileName}</div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="badge bg-warning text-white py-2 px-3" style="font-size: 0.875rem; border-radius: 15px;">${fileStatus}</div>
                                </div>
                            </div>
                        </div>
                    `;
                    // Insert the generated HTML for the file submission card
                    $('#taskCardContainer').html(fileCardHtml);
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
