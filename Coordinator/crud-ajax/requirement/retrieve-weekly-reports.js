// $(document).ready(function () {
//     let isFileOpen = false;

//     function fetchApprovedRequirements(searchTerm = '', requirementId = '') {
//         $.ajax({
//             url: 'controller/requirement/students-requirements/retrieve-approved-requirements.php',
//             method: 'GET',
//             data: {
//                 search_term: searchTerm,
//                 requirement_id: requirementId
//             },
//             dataType: 'json',
//             success: function (response) {
//                 if (response.status === 'success') {
//                     let submissions = response.data;
//                     let content = '';
//                     submissions.forEach(function (submission) {
//                         let submissionDate = formatSubmissionDate(submission.submission_date);

//                         content += `
//                         <div class="card task-card px-3 py-2 mb-3 submission-card position-relative" data-submission-id="${submission.submit_id}">
//                             <div class="d-flex align-items-center">
//                                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 3rem; height: 3rem; margin-right: 5px;">
//                                     <path fill="#d32923" d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-35.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z"/>
//                                 </svg>
//                                 <div class="d-flex flex-column justify-content-center mt-2">
//                                     <div class="d-flex justify-content-between align-items-center">
//                                         <p class="card-title mb-1 student-name">${submission.student_name}</p>
//                                         <h6 class="card-title fs-6 mb-1 mx-1 document-name">${submission.document_name}</h6>
//                                         <p class="card-text mb-1">is ${submission.status}</p>
//                                     </div>
//                                     <small class="text-muted submission-date">${submissionDate}</small>
//                                 </div>
//                             </div>
//                             <button class="btn btn-sm btn-danger px-3 position-absolute bottom-0 end-0 m-2 btn-reject mb-4" data-id="${submission.submit_id}">Reject</button>
//                             <button class="btn btn-sm btn-primary position-absolute bottom-0 start-0 m-2 btn-view-file" data-file-path="${submission.file_path}" style="display: none;">View File</button>
//                         </div>
//                         `;
//                     });
//                     $('#completedContent').html(content);
//                 } else {
//                     $('#completedContent').html('<p>No completed requirements found.</p>');
//                 }
//             },
//             error: function () {
//                 $('#completedContent').html('<p>An error occurred. Please try again later.</p>');
//             }
//         });
//     }

//     function openPDFModal(filePath) {
//         const pdfViewer = document.getElementById('pdfViewer');
//         const modal = document.getElementById('pdfModal');
        
//         pdfViewer.src = `${filePath}#toolbar=0`;

//         modal.style.display = 'flex';
//     }

//     document.getElementById('closeModal').addEventListener('click', function () {
//         const modal = document.getElementById('pdfModal');
//         const pdfViewer = document.getElementById('pdfViewer');
//         modal.style.display = 'none';
//         pdfViewer.src = '';
//     });

//     window.addEventListener('click', function (event) {
//         const modal = document.getElementById('pdfModal');
//         if (event.target === modal) {
//             modal.style.display = 'none';
//             document.getElementById('pdfViewer').src = '';
//         }
//     });

//     $('#completedModal').on('show.bs.modal', function () {
//         fetchRequirements();
//         fetchApprovedRequirements();
//     });

//     $('#completedSelectOption').on('change', function () {
//         const selectedRequirement = $(this).val();
//         const searchTerm = $('#completedSearchInput').val().trim();
//         fetchApprovedRequirements(searchTerm, selectedRequirement);
//     });

//     $('#completedSearchInput').on('input', function () {
//         const searchTerm = $(this).val().trim();
//         const selectedRequirement = $('#completedSelectOption').val();
//         fetchApprovedRequirements(searchTerm, selectedRequirement);
//     });

//     $(document).on('click', '.submission-card', function () {
//         var viewFileButton = $(this).find('.btn-view-file');
//         if (viewFileButton.length && !isFileOpen) {
//             isFileOpen = true;
//             const filePath = viewFileButton.data('file-path');
//             openPDFModal(filePath);

//             setTimeout(() => {
//                 isFileOpen = false;
//             }, 200);
//         }
//     });
// });

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
                        // Define submissionDate based on week_start (assuming it's a date field)
                        const submissionDate = new Date(item.week_start).toLocaleDateString(); // You can format this as you need

                        htmlContent += `
                            <div class="card task-card px-1 py-1 mb-3 submission-card position-relative" data-submission-id="${item.id}">
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
                    htmlContent = '<p>No reports found</p>';
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
        
        const fileExtension = filePath.split('.').pop().toLowerCase();

        if (fileExtension === 'pdf') {
            // If it's a PDF file
            fileViewer.src = `${filePath}#toolbar=0`;
            fileViewer.style.display = 'block';
            imageViewer.style.display = 'none';
        } else {
            // If it's an image file
            imageViewer.src = filePath;
            imageViewer.style.display = 'block';
            fileViewer.style.display = 'none';
        }

        modal.style.display = 'flex';
    }

    // Close modal event listener
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
