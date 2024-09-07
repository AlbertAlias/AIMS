let currentPage = 1;
let pageLength = 10;
let filters = {};
let searchTerm = '';
let lastFilters = {};  // To keep track of the last applied filters
let originalData = '';  // To store the original data

// Fetch and display table data
function loadTableData() {
    $.ajax({
        url: 'controller/manage-users/retrieve_tableData.php',
        type: 'GET',
        dataType: 'json',
        data: {
            page: currentPage,
            length: pageLength,
            search: searchTerm,
            filters: JSON.stringify(filters)  // Send filters as JSON
        },
        success: function(response) {
            try {
                if (response.html && response.pagination) {
                    $('#tdata').html(response.html);
                    $('#pagination').html(response.pagination);
                    $('#tableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);

                    // Store the original data if it's not already stored
                    if (!originalData) {
                        originalData = response.html;
                    }
                } else {
                    throw new Error('Unexpected response format');
                }
            } catch (e) {
                console.error('Error processing response:', e);
                console.error('Response:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
            console.error('Response text:', xhr.responseText);
        }
    });
}

// Handle filter option selection
$(document).on('change', '.filter-checkbox', function() {
    const filterKey = $(this).attr('id').replace('filter', '');

    // Store the state of the checkboxes
    const isUserTypeChecked = $('#filterUserType').is(':checked');
    const isDepartmentChecked = $('#filterDepartment').is(':checked');
    const isCompanyChecked = $('#filterCompany').is(':checked');

    if ($(this).is(':checked')) {
        // Lock/Unlock related checkboxes
        if (filterKey === 'UserType') {
            $('#filterDepartment, #filterCompany').prop('disabled', true);
        } else if (filterKey === 'Department' || filterKey === 'Company') {
            $('#filterUserType').prop('disabled', true);
        }
        
        // Store selected filters
        const filtersList = $('#filterModal').data('filters') || [];
        $('#filterModal').data('filters', [...filtersList, filterKey]);

        // Update the filter state
        filters[filterKey] = $('#filter' + filterKey + 'Select').val();
    } else {
        // Remove the filter from the list
        const filtersList = $('#filterModal').data('filters') || [];
        $('#filterModal').data('filters', filtersList.filter(f => f !== filterKey));

        // Unlock related checkboxes based on the current state
        if (filterKey === 'UserType') {
            if (!isDepartmentChecked && !isCompanyChecked) {
                $('#filterDepartment, #filterCompany').prop('disabled', false);
            }
        } else if (filterKey === 'Department' || filterKey === 'Company') {
            if (!isUserTypeChecked && !$('#filterDepartment').is(':checked') && !$('#filterCompany').is(':checked')) {
                $('#filterUserType').prop('disabled', false);
            }
        }

        // Clear the filter if the checkbox is unchecked
        delete filters[filterKey];
    }

    // If no filters are applied, reset to original data
    if (Object.keys(filters).length === 0) {
        $('#tdata').html(originalData);  // Reset to original data
    }
});

// Proceed button in dropdown
$(document).on('click', '#applyFiltersButton', function() {
    const selectedFilters = $('#filterModal').data('filters') || [];
    
    if (selectedFilters.length) {
        $('#filterModal').modal('show');
        $('#filterModalLabel').text('Apply Filters');
        
        // Clear existing content
        $('#filterInputContainer').html('');
        
        // Add each select box to the modal
        selectedFilters.forEach(filterKey => {
            $('#filterInputContainer').append(`
                <div class="mb-3">
                    <label for="filter${filterKey}Select" class="form-label">${filterKey}</label>
                    <select class="form-select" id="filter${filterKey}Select" aria-label="${filterKey} Select">
                        <!-- Options will be populated by AJAX -->
                    </select>
                </div>
            `);
            
            // Populate the select element with options
            $.ajax({
                url: 'controller/manage-users/retrieve_filterSelect.php',
                type: 'GET',
                dataType: 'json',
                data: { filterKey: filterKey },
                success: function(response) {
                    const $select = $(`#filter${filterKey}Select`);
                    $select.empty();
                    if (response.options.length) {
                        response.options.forEach(option => {
                            $select.append(`<option value="${option.value}">${option.text}</option>`);
                        });
                    } else {
                        $select.append(`<option value="">No data available</option>`);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error);
                }
            });
        });
    }
});

// Handle filter selection in modal
$(document).on('click', '#applyFilterButton', function() {
    const newFilters = {};
    $('#filterInputContainer select').each(function() {
        const filterKey = $(this).attr('id').replace('filter', '').replace('Select', '');
        const filterValue = $(this).val();
        if (filterValue) {
            newFilters[filterKey] = filterValue;
        }
    });

    filters = { ...filters, ...newFilters };
    $('#filterModal').modal('hide');

    // Check if filters have changed before reloading the table data
    if (JSON.stringify(filters) !== JSON.stringify(lastFilters)) {
        lastFilters = { ...filters };
        loadTableData(); // Reload the table data with new filters
    }
});

// Handle page length change
$('#pageLengthSelect').on('change', function() {
    pageLength = parseInt($(this).val());
    loadTableData();
});

// Handle search input
$('#searchInput').on('input', function() {
    searchTerm = $(this).val();
    loadTableData();
});

// Handle pagination
$(document).on('click', '.pagination li a', function(e) {
    e.preventDefault();
    currentPage = $(this).data('page');
    loadTableData();
});

// Initial load
$(document).ready(function() {
    loadTableData();
});

// Remove the 'x' button from the modal
$(document).ready(function() {
    $('.modal-header .btn-close').remove();  // Remove the 'x' button
});
