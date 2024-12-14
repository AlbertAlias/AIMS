$('#assignSupervisorModal').on('show.bs.modal', function () {
    // Fetch companies to populate the Company dropdown
    $.ajax({
        url: 'controller/requirement/retrieve-companies.php', // The PHP endpoint to fetch companies
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Populate the Company select element
            let companySelect = $('#companySelect');
            companySelect.empty(); // Clear any existing options
            companySelect.append('<option selected>Select Company</option>'); // Default option

            // Populate options for companies
            data.companies.forEach(function(company) {
                companySelect.append('<option value="' + company.company + '">' + company.company + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching companies:', error);
        }
    });
});