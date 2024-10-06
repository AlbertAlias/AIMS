$(document).ready(function () {
    $('#weekly-report-form').on('submit', function (e) {
        e.preventDefault(); // Prevent form from submitting normally

        // Collect form data
        var formData = {
            week: $('#week').val(),
            report_content: $('#report-content').val(),
        };

        // AJAX request to submit_weekly_report.php
        $.ajax({
            url: 'controller/weekly-reports/create-submit-weekly-reports.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                // Display success or error message
                $('#response-message').html(response);

                // Optionally, clear the form
                $('#weekly-report-form')[0].reset();
            },
            error: function () {
                $('#response-message').html('<div class="alert alert-danger">There was an error submitting the report. Please try again.</div>');
            }
        });
    });
});