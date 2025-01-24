$(document).ready(function() {
    let isFileOpen = false;

    function fetchWeeklyReports(searchQuery = '') {
        $.ajax({
            url: 'controller/requirement/students-requirements/retrieve-weekly-reports.php',
            type: 'GET',
            data: { search: searchQuery },
            success: function(response) {
                const data = JSON.parse(response);
                let htmlContent = '';
                if (data.length > 0) {
                    data.forEach(function(item) {
                        const submissionDate = new Date(item.week_start).toLocaleDateString();
            
                        htmlContent += `
                            <div class="card task-card px-1 py-1 mb-2 submission-card position-relative" data-submission-id="${item.id}">
                                <div class="d-flex align-items-center px-2 py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="icon" style="fill: #6f42c1; width: 3rem; height: 3.4rem; margin-right: 5px;">
                                        <path d="M64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-288-128 0c-17.7 0-32-14.3-32-32L224 0 64 0zM256 0l0 128 128 0L256 0zM112 256l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                    </svg>
                                    <div class="d-flex flex-column justify-content-center">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="card-title mb-1 student-name">${item.first_name} ${item.last_name}</p>
                                            <h6 class="card-title fs-6 mb-1 mx-1 document-name">${item.title}</h6>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-primary position-absolute bottom-0 start-0 m-2 btn-view-file" data-file-path="${item.file_path}" style="display: none;">View File</button>
                            </div>
                        `;
                    });
                } else {
                    htmlContent = '<p>No reports available</p>';
                }
                $('#weeklyreportContent').html(htmlContent);
            },
            error: function() {
                alert('Error fetching reports');
            }
        });
    }

    // Open the PDF or Image modal
    function openFileModal(filePath) {
        const modal = document.getElementById('pdfModal');
        const fileViewer = document.getElementById('pdfViewer');
        const imageViewer = document.getElementById('weeklyreportimageViewer');
    
        // Reset viewers
        fileViewer.src = '';
        imageViewer.src = '';
        fileViewer.style.display = 'none';
        imageViewer.style.display = 'none';
    
        // Check file extension and handle accordingly
        const fileExtension = filePath.split('.').pop().toLowerCase();
    
        if (fileExtension === 'pdf') {
            // Short delay to ensure the PDF source is properly updated
            const fileURL = `${filePath}#toolbar=0`;
            setTimeout(() => {
                fileViewer.src = fileURL;
            }, 50);  // Adding small delay
            fileViewer.style.display = 'block';
        } else if (['jpg', 'jpeg', 'png'].includes(fileExtension)) {
            imageViewer.src = filePath;
            imageViewer.style.display = 'block';
        }
    
        // Show modal
        modal.style.display = 'flex';
    }
    
    // Close modal functionality
    document.getElementById('closeModal').addEventListener('click', function () {
        const modal = document.getElementById('pdfModal');
        const pdfViewer = document.getElementById('pdfViewer');
        const imageViewer = document.getElementById('weeklyreportimageViewer');
        
        modal.style.display = 'none';
        pdfViewer.src = '';
        imageViewer.src = '';
    });
    

    window.addEventListener('click', function (event) {
        const modal = document.getElementById('pdfModal');
        if (event.target === modal) {
            modal.style.display = 'none';
            document.getElementById('pdfViewer').src = '';
            document.getElementById('weeklyreportimageViewer').src = '';
        }
    });

    // Handle file preview modal opening
    $(document).on('click', '.submission-card', function () {
        var viewFileButton = $(this).find('.btn-view-file');
        if (viewFileButton.length && !isFileOpen) {
            isFileOpen = true;
            const filePath = viewFileButton.data('file-path');
            openFileModal(filePath);

            setTimeout(() => {
                isFileOpen = false;
            }, 200);
        }
    });

    // Initial fetch of all reports
    fetchWeeklyReports();

    // Search functionality
    $('#weeklyreportSearchInput').on('input', function() {
        const searchQuery = $(this).val();
        fetchWeeklyReports(searchQuery);
    });
});
