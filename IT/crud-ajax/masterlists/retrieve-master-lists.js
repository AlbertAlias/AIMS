let masterlistsPage = 1;
let masterlistsPageLength = 10;

// Fetch and display table data
function loadTableData() {
    const selectedUserType = $('#userTypeDropdown').val();
    const selectedDepartmentId = $('#departmentDropdown').val();
    const selectedCompany = $('#companyDropdown').val();

    $.ajax({
        url: 'controller/masterlists/retrieve-master-lists.php',
        type: 'GET',
        dataType: 'json',
        data: {
            page: masterlistsPage,
            length: masterlistsPageLength,
            search: $('#master-lists-searchInput').val(),
            user_type: selectedUserType,
            department_id: selectedDepartmentId,
            company: selectedCompany
        },
        success: function(response) {
            console.log('Response:', response);
            if (response.html) {
                $('#master-lists tbody').html(response.html);
            }
            if (response.pagination) {
                $('#master-lists-pagination').html(response.pagination);
            }
            $('#master-lists-tableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            console.log('Response Text:', xhr.responseText);
        }
    });
}

function toggleColumns(userType) {
    const columnsToHide = {
        IT: ['Department', 'Company', 'AY'],
        Dean: ['Department', 'Company', 'AY'],
        Coordinator: ['Company', 'AY'],
        Student: ['Company'],
        Supervisor: ['Department', 'AY'],
        Registrar: ['Department', 'Company', 'AY']
    };

    // Reset all column visibility
    $('#master-lists thead th').show();
    $('#master-lists tbody tr').each(function () {
        $(this).find('td').show();
    });

    // Hide specific columns only if a user type is selected
    if (userType && columnsToHide[userType]) {
        columnsToHide[userType].forEach(columnName => {
            const columnIndex = $(`#master-lists thead th:contains(${columnName})`).index();
            if (columnIndex > -1) {
                $(`#master-lists thead th:eq(${columnIndex})`).hide();
                $('#master-lists tbody tr').each(function () {
                    $(this).find(`td:eq(${columnIndex})`).hide();
                });
            }
        });
    }
}

// Event listeners
$('#master-lists-pageLengthSelect').on('change', function() {
    masterlistsPageLength = parseInt($(this).val());
    masterlistsPage = 1;
    loadTableData();
});

$('#master-lists-searchInput').on('input', function() {
    masterlistsPage = 1;
    loadTableData();
});

$('#master-lists-pagination').on('click', '.page-link', function(e) {
    e.preventDefault();
    masterlistsPage = $(this).data('page');
    loadTableData();
});

$('#userTypeDropdown').on('change', function () {
    masterlistsPage = 1; // Reset to first page
    loadTableData(); // Reload the table with the selected user type
});

$('#departmentDropdown').on('change', function () {
    masterlistsPage = 1; // Reset to first page
    loadTableData(); // Reload the table with the selected user type
});

$('#companyDropdown').on('change', function () {
    masterlistsPage = 1; // Reset to first page
    loadTableData(); // Reload the table with the selected user type
});

$('#userTypeDropdown').on('change', function () {
    const selectedUserType = $(this).val();
    masterlistsPage = 1; // Reset to first page
    toggleColumns(selectedUserType); // Toggle columns visibility
    loadTableData(); // Reload the table with the selected user type
});

// Initial load with default behavior (all columns visible)
toggleColumns(''); // Show all columns
// Initial load
loadTableData();