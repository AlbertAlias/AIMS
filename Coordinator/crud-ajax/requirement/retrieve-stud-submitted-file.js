// $(document).ready(function () {
//     const $submissionTable = $("#submissionTable tbody");

//     const fetchSubmissions = () => {
//         $.ajax({
//             url: 'controller/retrieve-stud-submitted-file.php',
//             method: 'GET',
//             dataType: 'json',
//             success: (data) => {
//                 if (data.success) {
//                     renderSubmissions(data.submissions);
//                 }
//             },
//             error: (xhr, status, error) => {
//                 console.error("Error fetching submissions:", error);
//             }
//         });
//     };

//     const renderSubmissions = (submissions) => {
//         const rows = submissions.map(sub => `
//             <tr>
//                 <td>${sub.id}</td>
//                 <td>${sub.student_id}</td>
//                 <td>${sub.file_name}</td>
//                 <td>${sub.status}</td>
//                 <td>
//                     <button class="btn btn-success btn-sm" onclick="reviewSubmission(${sub.id}, 'approve')">Approve</button>
//                     <button class="btn btn-danger btn-sm" onclick="reviewSubmission(${sub.id}, 'disapprove')">Disapprove</button>
//                 </td>
//             </tr>
//         `).join('');
//         $submissionTable.html(rows);
//     };

//     window.reviewSubmission = (submissionId, action) => {
//         const message = action === 'disapprove' ? prompt("Provide feedback for disapproval:") : '';
        
//         $.ajax({
//             url: 'controller/review_submission.php',
//             method: 'POST',
//             dataType: 'json',
//             data: {
//                 submission_id: submissionId,
//                 action: action,
//                 message: message
//             },
//             success: (result) => {
//                 if (result.success) {
//                     alert("Action executed successfully");
//                     fetchSubmissions();
//                 } else {
//                     alert("Error: " + result.error);
//                 }
//             },
//             error: (xhr, status, error) => {
//                 console.error("Error processing review:", error);
//             }
//         });
//     };

//     fetchSubmissions();
// });


$(document).ready(function () {
    const fetchSubmissions = () => {
        $.ajax({
            url: 'controller/retrieve-stud-submitted-file.php',
            method: 'GET',
            dataType: 'json',
            success: (data) => {
                if (data.success) {
                    renderSubmissions(data.submissions);
                } else {
                    console.error("Error:", data.error);
                }
            },
            error: (xhr, status, error) => {
                console.error("Error fetching submissions:", error);
            }
        });
    };

    const renderSubmissions = (submissions) => {
        const pending = submissions.filter(sub => sub.status === 'pending');
        const approved = submissions.filter(sub => sub.status === 'approved');
        const rejected = submissions.filter(sub => sub.status === 'rejected');

        renderSection("#stud-requirements .col-lg-4:nth-child(1)", pending, "Pending");
        renderSection("#stud-requirements .col-lg-4:nth-child(2)", approved, "Approved");
        renderSection("#stud-requirements .col-lg-4:nth-child(3)", rejected, "Rejected");
    };

    const renderSection = (selector, submissions, status) => {
        const container = $(selector);

        const list = submissions.map(sub => {
            // Format submission_date to Month and Day only
            const submissionDate = new Date(sub.submission_date);
            const formattedDate = submissionDate.toLocaleString('default', { month: 'short', day: 'numeric' });

            return `
            <div class="card task-card px-3 py-2 mb-4 submission-card position-relative" data-submission-id="${submission.submit_id}" style="cursor: pointer;">
                <div class="d-flex align-items-center">
                    <!-- PDF Icon on the left, made larger -->
                    <i class="fa-solid fa-file-pdf me-3" style="font-size: 3rem;"></i>
            
                    <!-- Document Name on the right -->
                    <div class="d-flex flex-column">
                        <h5 class="card-title fs-6 mb-1">${submission.document_name}</h5>
                        <small class="text-muted">Submitted on: ${submission.submission_date}</small>
                    </div>
                </div>
            
                <!-- Status and Buttons -->
                <div class="d-flex justify-content-between mt-2">
                    <p class="card-text mb-1">
                        <strong>Status: ${submission.status}</strong>
                    </p>
                    <div>
                        <button class="btn btn-success btn-sm btn-approve" data-id="${submission.submit_id}">Approve</button>
                        <button class="btn btn-danger btn-sm btn-reject" data-id="${submission.submit_id}">Reject</button>
                    </div>
                </div>
            </div>
            `;
        }).join('');

        container.html(`
            <h5 class="mb-3">${status} Requirements (${submissions.length})</h5>
            ${list || `<p>No ${status.toLowerCase()} submissions.</p>`}
        `);

        // Attach event listeners for the buttons
        attachButtonListeners();
    };

    const attachButtonListeners = () => {
        $(".btn-approve").on("click", function () {
            const submissionId = $(this).data("id");
            updateSubmissionStatus(submissionId, "approved");
        });

        $(".btn-reject").on("click", function () {
            const submissionId = $(this).data("id");
            updateSubmissionStatus(submissionId, "rejected");
        });
    };

    const updateSubmissionStatus = (submissionId, status) => {
        $.ajax({
            url: 'controller/requirement/update-stud-file-status.php',
            method: 'POST',
            data: { submissionId, status },
            success: (response) => {
                if (response.success) {
                    fetchSubmissions(); // Refresh the data
                } else {
                    console.error("Error:", response.error);
                }
            },
            error: (xhr, status, error) => {
                console.error("Error updating status:", error);
            }
        });
    };

    fetchSubmissions();
});
