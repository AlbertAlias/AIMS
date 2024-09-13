<!-- Begin Page Content -->
<div class="container-fluid bg-light p-0 m-0">
        <!-- Section for report submission -->
        <section id="submit-report">
        <h3>Submit Weekly Report</h3>
        <form action="upload-weekly-report.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="week">Week Number:</label>
                <input type="text" name="week" id="week" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="report">Upload Report (PDF or DOCX):</label>
                <input type="file" name="report" id="report" class="form-control" accept=".pdf,.docx" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Report</button>
        </form>
    </section>

    <!-- Section to display submitted reports -->
    <section id="report-history">
        <h3>Your Submitted Reports</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Week Number</th>
                    <th>Submission Date</th>
                    <th>Status</th>
                    <th>Feedback</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <!-- Reports will be displayed here -->
                <?php
                // Loop through reports data fetched from the database
                foreach ($reports as $report) {
                    echo "<tr>";
                    echo "<td>{$report['week']}</td>";
                    echo "<td>{$report['submission_date']}</td>";
                    echo "<td>{$report['status']}</td>";
                    echo "<td>{$report['feedback']}</td>";
                    echo "<td><a href='uploads/{$report['file']}' download>Download</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
</div>