// Handle form submission with AJAX
$('#postRequirementsForm').on('submit', function (event) {
    event.preventDefault(); // Prevent default form submission

    // Get form data
    var formData = $(this).serialize();

    // Send AJAX request to post the requirement
    $.ajax({
        url: 'controller/post-requirements/create-requirements.php', // Path to the PHP file that processes the form
        type: 'POST',
        data: formData,
        dataType: 'json', // Expect JSON response
        success: function (response) {
            if (response.status === "success") {
                $('#responseMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                $('#postRequirementsForm')[0].reset(); // Reset form fields
            } else {
                $('#responseMessage').html('<div class="alert alert-danger">' + response.message + '</div>');
            }
        },
        error: function (xhr, status, error) {
            // Display AJAX error message
            $('#responseMessage').html(
                '<div class="alert alert-danger">AJAX error: ' + error + '<br>Response: ' + xhr.responseText + '</div>'
            );
        }
    });
});

// Cancel button functionality
$('#cancelPost').on('click', function () {
    $('#post-requirements').hide(); // Hide the form section
});