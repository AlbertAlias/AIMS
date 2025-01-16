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
            } else {
                $('#ojthours tbody').html('<tr><td colspan="7">No data available</td></tr>');
            }

            if (response.pagination) {
                $('#ojthours-pagination').html(response.pagination);
            } else {
                $('#ojthours-pagination').html('');
            }
            $('#ojthours-tableInfo').text(response.total > 0 ? `Showing ${response.start} to ${response.end} of ${response.total} entries` : 'No entries available');

            $('#totalHoursDisplay').text(`Rendered Hours: ${response.total_hours_sum || '0'}`);
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

$('#ojthours').on('click', '.delete-button', function() {
    const recordId = $(this).data('id');
    const $row = $(this).closest('tr'); // Get the corresponding table row

    Swal.fire({
        title: 'Are you sure?',
        text: "This record will be deleted permanently!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'btn btn-secondary'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'controller/hours/retrieve-ojthours.php',
                type: 'DELETE',
                dataType: 'json',
                data: { id: recordId },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            toast: true,
                            position: 'top-right',
                            icon: 'success',
                            title: 'Record deleted successfully!',
                            showConfirmButton: false,
                            timer: 2000,
                            background: '#b9f6ca',
                            iconColor: '#2e7d32',
                            color: '#155724',
                            customClass: {
                                popup: 'mt-5'
                            }
                        });
                        $row.remove(); // Remove the row from the table on success
                        loadOjtHoursData(); // Refresh data after deletion
                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'top-right',
                            icon: 'error',
                            title: 'Failed to delete the record!',
                            showConfirmButton: false,
                            timer: 2000,
                            background: '#f8d7da',
                            iconColor: '#721c24',
                            color: '#721c24',
                            customClass: {
                                popup: 'mt-5'
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'error',
                        title: 'An error occurred while deleting the record.',
                        showConfirmButton: false,
                        timer: 2000,
                        background: '#f8d7da',
                        iconColor: '#721c24',
                        color: '#721c24',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                }
            });
        }
    });
});

loadOjtHoursData();