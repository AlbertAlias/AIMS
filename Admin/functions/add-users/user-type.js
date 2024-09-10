$(document).ready(function() {
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