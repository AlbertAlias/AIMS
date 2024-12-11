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

                    // Add file details to the task card container
                    $('#taskCardContainer').html(`
                        <div class="file-preview">
                            <div class="file-icon">
                                <i class="bi bi-file-earmark-pdf text-danger"></i>
                            </div>
                            <div class="file-details">
                                <p class="file-name">${fileName}</p>
                                <p class="file-status">Status: ${fileStatus}</p>
                            </div>
                        </div>
                    `);
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