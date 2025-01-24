$(document).ready(function () {
    $('#weekly-reports-tab').on('click', function () {
        if (!$('#weekly-reports').data('loaded')) {
            $.ajax({
                url: 'controller/requirements-folder/retrieve-weekly-reports.php',
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        const reports = response.data;
                        let content = '';

                        if (reports.length > 0) {
                            reports.forEach((report) => {
                                const weekStart = new Date(report.week_start);
                                const weekEnd = new Date(report.week_end);

                                const formattedWeekStart = weekStart.toLocaleDateString('en-US', {
                                    year: 'numeric',
                                    month: 'short',
                                    day: 'numeric'
                                });

                                const formattedWeekEnd = weekEnd.toLocaleDateString('en-US', {
                                    year: 'numeric',
                                    month: 'short',
                                    day: 'numeric'
                                });

                                content += `
                                    <div class="card mb-2" data-file-path="${report.file_path}">
                                        <div class="card-body d-flex align-items-start py-2 px-2">
                                            <span class="me-2" style="flex-shrink: 0;">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="48" height="48">
                                                    <path fill="#d32923" d="M0 96C0 60.7 28.7 32 64 32l384 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64L0 96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6l96 0 32 0 208 0c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                                                </svg>
                                            </span>
                                            <div>
                                                <h5 class="card-title" style="margin-bottom: 0;">${report.title}</h5>
                                                <p class="card-text">
                                                    ${formattedWeekStart} to ${formattedWeekEnd}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            });
                        } else {
                            content = '<p class="text-muted">No weekly reports available.</p>';
                        }

                        $('#weekly-reports').html(content);
                        $('#weekly-reports').data('loaded', true);
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert('An error occurred while retrieving the weekly reports.');
                }
            });
        }
    });

    $('#weekly-reports').on('click', '.card', function () {
        const filePath = $(this).data('file-path');
        showFileInModal(filePath);
    });

    function showFileInModal(filePath) {
        const fileModal = document.getElementById('fileModal');
        const fileViewer = document.getElementById('fileViewer');
        const fileImageViewer = document.getElementById('fileimageViewer');
        
        const fileExtension = filePath.split('.').pop().toLowerCase();

        if (fileExtension === 'pdf') {
            fileViewer.src = filePath + '#toolbar=0';
            fileViewer.style.display = 'block';
            fileImageViewer.style.display = 'none';
        } else if (['jpg', 'jpeg', 'png'].includes(fileExtension)) {
            fileImageViewer.src = filePath;
            fileImageViewer.style.display = 'block';
            fileViewer.style.display = 'none';
        }

        fileModal.style.display = 'flex';
    }

    document.getElementById('filecloseModal').addEventListener('click', function () {
        const fileModal = document.getElementById('fileModal');
        const fileViewer = document.getElementById('fileViewer');
        const fileImageViewer = document.getElementById('fileimageViewer');

        fileModal.style.display = 'none';
        fileViewer.src = '';
        fileImageViewer.src = '';
    });
});