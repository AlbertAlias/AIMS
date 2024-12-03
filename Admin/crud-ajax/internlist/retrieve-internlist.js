let currentPage = 1;
let pageLength = 10;

// Show loader while fetching data
function showLoader(isLoading) {
    if (isLoading) {
        $('#tdata').html('<tr><td colspan="6">Loading...</td></tr>');
    }
}

// Fetch and display table data
function loadTableData() {
    showLoader(true);
    $.ajax({
        url: 'controller/internlist/retrieve-internlist.php',
        type: 'GET',
        dataType: 'json',
        data: {
            page: currentPage,
            length: pageLength,
            search: $('#searchInput').val(),
            department: $('#filterDepartment').val(), // Include department filter
        },
        success: function (response) {
            showLoader(false);
            if (response.html) {
                $('#tdata').html(response.html);
            }
            if (response.pagination) {
                $('#pagination').html(response.pagination);
            }
            $('#tableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);
        },
        error: function (xhr, status, error) {
            showLoader(false);
            console.error('AJAX error:', status, error);
            console.log('Response Text:', xhr.responseText);
            alert('Error fetching the intern list.');
        },
    });
}

// Load department options for the filter dropdown
function loadDepartmentOptions() {
    $.ajax({
        url: 'controller/internlist/retrieve-depts.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            const departmentSelect = $('#filterDepartment');
            departmentSelect.empty().append('<option value="">All Departments</option>');
            response.forEach(department => {
                departmentSelect.append(`<option value="${department.id}">${department.department_name}</option>`);
            });
        },
        error: function () {
            alert('Failed to load departments.');
        }
    });
}

// Apply filters
$('#applyFiltersButton').on('click', function () {
    currentPage = 1;
    loadTableData();
});

// Handle page length change
$('#pageLengthSelect').on('change', function () {
    pageLength = parseInt($(this).val());
    currentPage = 1;
    loadTableData();
});

// Handle pagination click
$(document).on('click', '.page-link', function (e) {
    e.preventDefault();
    const selectedPage = $(this).data('page');
    if (selectedPage) {
        currentPage = selectedPage;
        loadTableData();
    }
});

// Initialize on page load
$(document).ready(function () {
    loadDepartmentOptions(); // Load department dropdown options
    loadTableData();
});

// Initial data load
loadTableData();