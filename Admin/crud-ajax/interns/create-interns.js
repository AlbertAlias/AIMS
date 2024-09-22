$(document).ready(function () {
    $('#internsForm').on('submit', function (e) {
        e.preventDefault();

        $('#accountInfoForm input:disabled').prop('disabled', false);
        $('#internsForm input:disabled, #internsForm select:disabled').prop('disabled', false);

        var formData = $(this).serialize() + '&' + $('#accountInfoForm').serialize();
        console.log('Form Data:', formData);

        $.ajax({
            url: 'controller/interns/create-interns.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                console.log('AJAX response:', response);
                if (response.success) {
                    alert('Intern added successfully!');
                    disableAndResetForms();
                    loadInterns();
                } else {
                    alert('Failed to add intern: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
                console.log('Response Text:', xhr.responseText);
                alert('An error occurred while processing the request: ' + xhr.responseText);
            },
            complete: function () {
                disableAndResetForms();
                $('#internsForm input').prop('disabled', true);
                $('#internsForm select').prop('disabled', true);
                $('#accountInfoForm input').prop('disabled', true);
            }
        });
    });
});