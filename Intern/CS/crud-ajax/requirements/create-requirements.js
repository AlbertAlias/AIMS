$(document).ready(function () {
    $('#requirements-form').on('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        // Create a FormData object to handle file uploads
        var formData = new FormData(this);

        $.ajax({
            url: 'controller/requirements/create-submit-requirements.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // Display success or error message
                $('#response-message').html(response);

                // Optionally, clear the form after success
                $('#requirements-form')[0].reset();
            },
            error: function () {
                $('#response-message').html('<div class="alert alert-danger">There was an error submitting the requirements. Please try again.</div>');
            }
        });
    });
});