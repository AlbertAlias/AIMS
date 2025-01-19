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
                                <div class="card mb-2">
                                    <div class="card-body d-flex align-items-start py-2 px-2">
                                        <!-- SVG Icon on the left -->
                                        <span class="me-2" style="flex-shrink: 0;">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="48" height="48">
                                                <path fill="#d32923" d="M0 96C0 60.7 28.7 32 64 32l384 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64L0 96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6l96 0 32 0 208 0c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                                            </svg>
                                        </span>

                                        <!-- OJT Hours Title and Info to the right -->
                                        <div>
                                            <h5 class="card-title">${formattedSubmissionDate}</h5>
                                            <p class="card-text">
                                                ${morningStart} to ${afternoonEnd}
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Hidden View Report Button (Initially hidden) -->
                                    ${record.file_path ? `<a href="${record.file_path}" class="btn btn-primary" target="_blank" style="display: none;" class="view-report-btn">View Report</a>` : ''}
                                </div>
                            `;
                        });
                    } else {
                        content = '<p class="text-muted">No OJT hours available.</p>';
                    }

                    $('#ojt-hours').html(content);

                    // Optional: Show the "View Report" button when needed
                    $('.view-report-btn').each(function() {
                        $(this).fadeIn();  // Use fadeIn() for smooth reveal, or just use .show() if preferred
                    });
                } else {
                    $('#ojt-hours').html(`<p class="text-danger">${response.message}</p>`);
                }
            },
            error: function () {
                $('#ojt-hours').html('<p class="text-danger">An error occurred while retrieving data.</p>');
            }
        });
    });
});
