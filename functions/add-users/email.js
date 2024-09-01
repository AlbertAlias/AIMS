$(document).ready(function() {
    $('#user_type').change(function() {
        if ($(this).val() === 'OJT Student') {
            $('#studentIDField').show();
            $('#email').prop('readonly', true);
        } else {
            $('#studentIDField').hide();
            $('#email').val('').prop('readonly', false);
        }
    });

    $('#studentID').on('input', function() {
        var studentID = $(this).val();
        var emailDomain = '@aims.edu.ph';
        if ($('#user_type').val() === 'OJT Student') {
            $('#email').val(studentID + emailDomain);
        }
    });

    // Trigger change event on page load to initialize state
    $('#user_type').trigger('change');
});