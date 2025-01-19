$(document).ready(function () {
    function fetchRequirements() {
        $.ajax({
            url: 'controller/requirements-folder/retrieve-all-requirements.php', // Replace with the actual path to your PHP script
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    const requirements = response.data;
                    let content = '';

                    if (requirements.length > 0) {
                        content += '<ul class="list-group">';
                        requirements.forEach((req) => {
                            content += `
                                <li class="list-group-item">
                                    <strong>Document:</strong> ${req.document_name}<br>
                                    <strong>Submission Date:</strong> ${new Date(req.submission_date).toLocaleDateString()}<br>
                                    <strong>Status:</strong> ${req.status}<br>
                                    <a href="${req.file_path}" target="_blank" class="btn btn-sm btn-success mt-2">View Document</a>
                                </li>
                            `;
                        });
                        content += '</ul>';
                    } else {
                        content = '<p>No approved requirements found.</p>';
                    }

                    // Update the placeholder content
                    $('#requirements-content').html(content);
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
});