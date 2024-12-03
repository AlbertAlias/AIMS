<div class="container-fluid bg-light p-0 m-0" id="weekly-reports" style="display: none;">
    <h3>Weekly Reports</h3>
    <form id="weekly-report-form" method="POST">
        <div class="mb-3">
        <label for="intern-id" class="form-label">Intern ID</label>
        <input type="text" class="form-control" id="intern-id" name="intern_id" placeholder="Enter Intern ID" required>
        </div>
        <div class="mb-3">
            <label for="report-content" class="form-label">Report Content</label>
            <textarea class="form-control" id="report-content" name="report_content" rows="5" placeholder="Enter weekly report details" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Report</button>
    </form>
    <div id="response-message" class="mt-3"></div>
</div>