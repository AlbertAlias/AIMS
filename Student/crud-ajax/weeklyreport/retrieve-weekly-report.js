$(document).ready(function () {
    function fetchWeeklyReports() {
        $.ajax({
            url: 'controller/weeklyreport/retrieve-weekly-report.php',
            method: 'GET',
            dataType: 'json',
            success: function (result) {
                if (result.success) {
                    renderReports(result.data);
                } else {
                    alert('Failed to load reports: ' + result.error);
                }
            },
            error: function (xhr, status, error) {
                console.error('Unexpected error:', error);
                alert('An unexpected error occurred');
            }
        });
    }

    function renderReports(data) {
        const $container = $('#weeklypostedRequirementsContainer');
        $container.empty();
    
        if (data.length === 0) {
            $container.html('<div class="col-12">No weekly reports available.</div>');
            return;
        }

        const formatDate = (dateString) => {
            const options = { month: 'short', day: 'numeric' };
            return new Intl.DateTimeFormat('en-US', options).format(new Date(dateString));
        };
    
        data.forEach(function (report) {
            const formattedStart = formatDate(report.week_start);
            const formattedEnd = formatDate(report.week_end);

            const reportCard = `
            <div class="col-12 mb-3">
                <div class="card report-card px-3 py-3 position-relative" style="border-left: 4px solid #198754; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;" data-file-path="${report.file_path}">
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Title with Dropdown -->
                        <div>
                            <p class="mb-1" style="font-weight: 500; color: #333; font-size: 1.1rem;">
                                <span style="color: #198754;">${report.title}</span>
                            </p>
                            <div class="card-text m-0 p-0" style="font-size: 1rem; color: #555;">
                                ${formattedStart} to ${formattedEnd}
                            </div>
                        </div>
                        <!-- Dropdown Icon -->
                        <div class="dropdown ms-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512" width="34" height="34" class="dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <path fill="#198754" d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/>
                            </svg>
                            <ul class="dropdown-menu report-dropdown-menu dropdown-menu-end dropdown-menu-sm-start">
                                <li><button class="dropdown-item delete-btn" data-id="${report.id}">Delete</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            `;
            $container.append(reportCard);
        });
    
        $('.report-card').click(function () {
            const filePath = $(this).data('file-path');
            showFileInModal(filePath);
        });

        $('.dropdown-icon').click(function (event) {
            event.stopPropagation();
        });

        $('.delete-btn').click(function (event) {
            event.stopPropagation();
            const reportId = $(this).data('id');
            deleteReport(reportId);
        });
    }

    function showFileInModal(filePath) {
        const reportModal = document.getElementById('reportModal');
        const reportViewer = document.getElementById('reportViewer');
        const imageViewer = document.getElementById('imageViewer');
        const fileURL = filePath;

        if (filePath.endsWith('.pdf')) {
            reportViewer.src = `${fileURL}#toolbar=0`;
            reportViewer.style.display = 'block';
            imageViewer.style.display = 'none';
        } else if (['.jpg', '.jpeg', '.png'].some(ext => filePath.endsWith(ext))) {
            imageViewer.src = fileURL;
            imageViewer.style.display = 'block';
            reportViewer.style.display = 'none';
        }

        reportModal.style.display = 'flex';
    }

    document.getElementById('report-closeModal').addEventListener('click', function () {
        document.getElementById('reportModal').style.display = 'none';
        document.getElementById('reportViewer').src = '';
        document.getElementById('imageViewer').src = '';
    });

    function deleteReport(reportId) {
        $.ajax({
            url: 'controller/weeklyreport/delete-weekly-report.php',
            method: 'POST',
            data: { id: reportId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Report deleted successfully');
                    fetchWeeklyReports();
                } else {
                    alert('Failed to delete report: ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Unexpected error:', error);
                alert('An unexpected error occurred while deleting the report');
            }
        });
    }

    fetchWeeklyReports();
});