document.addEventListener('DOMContentLoaded', async () => {
    const submissionTable = document.querySelector("#submissionTable tbody");

    const fetchSubmissions = async () => {
        const response = await fetch('controller/fetch_submissions.php');
        const data = await response.json();
        
        if (data.success) {
            renderSubmissions(data.submissions);
        }
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
        submissionTable.innerHTML = rows;
    };

    window.reviewSubmission = async (submissionId, action) => {
        const message = action === 'disapprove' ? prompt("Provide feedback for disapproval:") : '';
        const response = await fetch("controller/review_submission.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `submission_id=${submissionId}&action=${action}&message=${message}`
        });

        const result = await response.json();
        if (result.success) {
            alert("Action executed successfully");
            fetchSubmissions();
        } else {
            alert("Error: " + result.error);
        }
    };

    fetchSubmissions();
});