$(document).ready(function () {
    const $submissionTable = $("#submissionTable tbody");

    const fetchSubmissions = () => {
        $.ajax({
            url: 'controller/fetch_submissions.php',
            method: 'GET',
            dataType: 'json',
            success: (data) => {
                if (data.success) {
                    renderSubmissions(data.submissions);
                }
            },
            error: (xhr, status, error) => {
                console.error("Error fetching submissions:", error);
            }
        });
    };

    const renderSubmissions = (submissions) => {
        const rows = submissions.map(sub => `
            <tr>
                <td>${sub.id}</td>
                <td>${sub.student_id}</td>
                <td>${sub.file_name}</td>
                <td>${sub.status}</td>
                <td>
                    <button class="btn btn-success btn-sm" onclick="reviewSubmission(${sub.id}, 'approve')">Approve</button>
                    <button class="btn btn-danger btn-sm" onclick="reviewSubmission(${sub.id}, 'disapprove')">Disapprove</button>
                </td>
            </tr>
        `).join('');
        $submissionTable.html(rows);
    };

    window.reviewSubmission = (submissionId, action) => {
        const message = action === 'disapprove' ? prompt("Provide feedback for disapproval:") : '';
        
        $.ajax({
            url: 'controller/review_submission.php',
            method: 'POST',
            dataType: 'json',
            data: {
                submission_id: submissionId,
                action: action,
                message: message
            },
            success: (result) => {
                if (result.success) {
                    alert("Action executed successfully");
                    fetchSubmissions();
                } else {
                    alert("Error: " + result.error);
                }
            },
            error: (xhr, status, error) => {
                console.error("Error processing review:", error);
            }
        });
    };

    fetchSubmissions();
});