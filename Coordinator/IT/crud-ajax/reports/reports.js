document.addEventListener('DOMContentLoaded', () => {
    // Fetch and display data
    function fetchReports() {
        fetch('controller/reports/get_interns.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('weeklytdata');
            tbody.innerHTML = data.map(intern => `
                <tr>
                    <td>${intern.first_name}</td>
                    <td>${intern.last_name}</td>
                    <td>${intern.student_id}</td>
                    <td colspan="6">
                        <button class="btn btn-primary btn-sm" onclick="viewReport(${intern.student_id})">View Weekly Report</button>
                    </td>
                </tr>
            `).join('');
        })
        .catch(err => console.error('Error fetching reports:', err));
    }

    fetchReports();

    // View Weekly Report
    window.viewReport = function(student_id) {
        fetch(`controller/reports/get_report.php?studentId=${student_id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('reportContent').textContent = data.report;
            document.getElementById('approveReport').onclick = () => handleReportAction(student_id, 'approve');
            document.getElementById('disapproveReport').onclick = () => handleReportAction(student_id, 'disapprove');
            new bootstrap.Modal(document.getElementById('weeklyReportModal')).show();
        })
        .catch(err => console.error('Error fetching report:', err));
    };

    // Approve or Disapprove Report
    function handleReportAction(student_id, action) {
        fetch('controller/reports/update_report_status.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ student_id, action })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert(`Report ${action}d successfully.`);
                fetchReports();
            } else {
                alert('Failed to update report status.');
            }
        })
        .catch(err => console.error('Error updating report status:', err));
    }
});
