let ojthoursPage = 1;
let ojthoursPageLength = 10;

$(document).on('click', '.open-ojthours-btn', function() {
    var userId = $(this).data('user-id');
    if (userId) {
        loadOjtHoursData(userId);
    } else {
        console.error('User ID is not defined!');
    }
});


function loadOjtHoursData(userId) {
    $.ajax({
        url: 'controller/student-lists/retrieve-stud-ojthours.php',
        type: 'GET',
        dataType: 'json',
        data: {
            user_id: userId,
            page: ojthoursPage,
            length: ojthoursPageLength,
            search: $('#ojthours-searchInput').val()
        },
        success: function(response) {
            if (response.error) {
                alert(response.error);
                return;
            }
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
    var userId = $('.open-ojthours-btn').data('user-id'); 
    loadOjtHoursData(userId);
});

$('#ojthours-searchInput').on('input', function() {
    ojthoursPage = 1;
    var userId = $('.open-ojthours-btn').data('user-id'); 
    loadOjtHoursData(userId);
});

$('#ojthours-pagination').on('click', '.page-link', function(e) {
    e.preventDefault();
    ojthoursPage = $(this).data('page');
    var userId = $('.open-ojthours-btn').data('user-id'); 
    loadOjtHoursData(userId);
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
        $('#stud-ojthoursModal').show();
    }
});

$('#ojthours-closeModal').on('click', function() {
    $('#stud-ojthoursModal').hide();
    $('#ojthoursViewer').hide();
    $('#ojtimageViewer').hide();
});