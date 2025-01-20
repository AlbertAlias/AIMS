$(document).ready(function () {
    $('#ojt-hours-tab').on('click', function () {
        $.ajax({
            url: 'controller/requirements-folder/retrieve-ojt-hours.php', // Path to the PHP script
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    const ojtHoursData = response.data;
                    let content = '';

                    if (ojtHoursData.length > 0) {
                        ojtHoursData.forEach((record) => {
                            // Function to format 24-hour time to 12-hour with AM/PM
                            function formatTime(timeStr) {
                                let hours = parseInt(timeStr.split(':')[0]);
                                let minutes = timeStr.split(':')[1] || '00'; // Handle case if minutes are not present
                                let suffix = hours >= 12 ? 'pm' : 'am';
                                hours = hours % 12 || 12; // Convert 0 hour to 12 (for midnight)
                                return `${hours}:${minutes} ${suffix}`;
                            }

                            // Format the submission date for display
                            const submissionDate = new Date(record.submission_date);
                            const formattedSubmissionDate = submissionDate.toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'short',
                                day: 'numeric'
                            });

                            // Format the morning and afternoon start/end times
                            const morningStart = formatTime(record.morning_start);
                            const afternoonEnd = formatTime(record.afternoon_end);

                            content += `
                                <div class="card mb-2" data-file-path="${record.file_path}">
                                    <div class="card-body d-flex align-items-start py-2 px-2">
                                        <span class="me-2" style="flex-shrink: 0;">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="48" height="48">
                                                <path fill="#d32923" d="M0 96C0 60.7 28.7 32 64 32l384 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64L0 96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6l96 0 32 0 208 0c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                                            </svg>
                                        </span>

                                        <div>
                                            <h5 class="card-title" style="margin-bottom: 0;">${formattedSubmissionDate}</h5>
                                            <p class="card-text">
                                                ${morningStart} to ${afternoonEnd}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                    } else {
                        content = '<p class="text-muted">No OJT hours available.</p>';
                    }

                    $('#ojt-hours').html(content);
                } else {
                    $('#ojt-hours').html(`<p class="text-danger">${response.message}</p>`);
                }
            },
            error: function () {
                $('#ojt-hours').html('<p class="text-danger">An error occurred while retrieving data.</p>');
            }
        });
    });

    // Use event delegation to handle click on dynamically loaded cards
    $('#ojt-hours').on('click', '.card', function () {
        const filePath = $(this).data('file-path');
        showFileInModal(filePath);
    });

    // Function to show file in modal
    function showFileInModal(filePath) {
        const fileModal = document.getElementById('fileModal');
        const fileViewer = document.getElementById('fileViewer');
        const fileImageViewer = document.getElementById('fileimageViewer');
        
        const fileExtension = filePath.split('.').pop().toLowerCase();

        // Check file type and display accordingly
        if (fileExtension === 'pdf') {
            fileViewer.src = filePath + '#toolbar=0';
            fileViewer.style.display = 'block';
            fileImageViewer.style.display = 'none';
        } else if (['jpg', 'jpeg', 'png'].includes(fileExtension)) {
            fileImageViewer.src = filePath;
            fileImageViewer.style.display = 'block';
            fileViewer.style.display = 'none';
        }

        // Show modal
        fileModal.style.display = 'flex';
    }

    // Close the modal
    document.getElementById('filecloseModal').addEventListener('click', function () {
        const fileModal = document.getElementById('fileModal');
        const fileViewer = document.getElementById('fileViewer');
        const fileImageViewer = document.getElementById('fileimageViewer');

        fileModal.style.display = 'none';
        fileViewer.src = '';
        fileImageViewer.src = '';
    });
});