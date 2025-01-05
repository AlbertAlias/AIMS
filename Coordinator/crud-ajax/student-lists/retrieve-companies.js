$('#assignSupervisorModal').on('show.bs.modal', function () {
    $.ajax({
        url: 'controller/student-lists/retrieve-companies.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            let companySelect = $('#companySelect');
            companySelect.empty();
            companySelect.append('<option selected>Select Company</option>');

            data.companies.forEach(function(company) {
                companySelect.append('<option value="' + company.company + '">' + company.company + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching companies:', error);
        }
    });
});