$(document).ready(function() {
    // Show/Hide fields based on user type selection
    $('#user_type').change(function() {
        var userType = $(this).val();
        $('#departmentField, #studentIDField, #companyField').hide();
        
        if (userType === 'OJT Student') {
            $('#departmentField, #studentIDField').show();
        } else if (userType === 'OJT Coordinator') {
            $('#departmentField').show();
        } else if (userType === 'OJT Supervisor') {
            $('#companyField').show();
        }
    }).trigger('change');
});