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
    showLoader(true); // Display loader
    $.ajax({
        url: 'controller/internlist/retrieve-internlist.php',
        type: 'GET',
        dataType: 'json',
        data: {
            page: currentPage,
            length: pageLength,
            search: $('#searchInput').val(),
        },
        success: function (response) {
            showLoader(false); // Hide loader
            if (response.html) {
                $('#tdata').html(response.html);
            }
            if (response.pagination) {
                $('#pagination').html(response.pagination);
            }
            $('#tableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);
        },
        error: function (xhr, status, error) {
            console.error('AJAX error:', status, error);
        },
    });
}

// Handle page length change
$('#pageLengthSelect').on('change', function () {
    pageLength = parseInt($(this).val());
    currentPage = 1; // Reset to the first page
    loadTableData();
});

// Handle search input with debounce
let debounceTimer;
$('#searchInput').on('input', function () {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        currentPage = 1; // Reset to the first page for new searches
        loadTableData();
    }, 300); // 300ms debounce
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

// Initial data load on page ready
$(document).ready(function () {
    loadTableData();
});


// Initial data load
loadTableData();