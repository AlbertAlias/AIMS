let ojthoursPage = 1;
let ojthoursPageLength = 10;

function loadOjtHoursData() {
    $.ajax({
        url: 'controller/hours/retrieve-ojthours.php',
        type: 'GET',
        dataType: 'json',
        data: {
            page: ojthoursPage,
            length: ojthoursPageLength,
            search: $('#ojthours-searchInput').val()
        },
        success: function(response) {
            if (response.html) {
                $('#ojthours tbody').html(response.html);
            }
            if (response.pagination) {
                $('#ojthours-pagination').html(response.pagination);
            }
            $('#ojthours-tableInfo').text(`Showing ${response.start} to ${response.end} of ${response.total} entries`);

            // $('#totalHoursDisplay').text(`Rendered Hours: ${response.total_hours_sum || '0'}`);
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
}

$('#ojthours-pageLengthSelect').on('change', function() {
    ojthoursPageLength = parseInt($(this).val());
    ojthoursPage = 1;
    loadOjtHoursData();
});

$('#ojthours-searchInput').on('input', function() {
    ojthoursPage = 1;
    loadOjtHoursData();
});

$('#ojthours-pagination').on('click', '.page-link', function(e) {
    e.preventDefault();
    ojthoursPage = $(this).data('page');
    loadOjtHoursData();
});

$('#ojthours').on('click', '.view-file-button', function() {
    var filePath = $(this).data('file');
    if (filePath) {
        if (filePath.endsWith('.pdf')) {
            $('#ojthoursViewer').show().attr('src', filePath + '#toolbar=0');
            $('#ojtimageViewer').hide();
        } else if (filePath.match(/\.(jpg|jpeg|png)$/)) {
            $('#ojtimageViewer').show().attr('src', filePath);
            $('#ojthoursViewer').hide();
        }
        $('#ojthoursModal').show();
    }
});

$('#ojthours-closeModal').on('click', function() {
    $('#ojthoursModal').hide();
    $('#ojthoursViewer').hide();
    $('#ojtimageViewer').hide();
});

loadOjtHoursData();