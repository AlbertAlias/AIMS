$(document).on('click', '.deleteButton', function () {
    const userId = $(this).data('user-id');

    Swal.fire({
        title: 'Archive User?',
        text: 'This user and all its data will be archived. This action is irreversible!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e74a3b',
        cancelButtonColor: '#858796',
        confirmButtonText: 'Archive',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'controller/masterlists/archive-users.php', // Ensure this path is correct
                type: 'POST',
                data: {
                    delete_user_id: userId
                },
                success: function (response) {
                    try {
                        const data = JSON.parse(response);
                        if (data.status === 'success') {
                            Swal.fire('Deleted!', data.message, 'success').then(() => {
                                location.reload(); // Reload to reflect the deletion
                            });
                        } else {
                            Swal.fire('Error', data.message, 'error');
                        }
                    } catch (e) {
                        Swal.fire('Error', 'Invalid response from server', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'An error occurred while processing your request', 'error');
                }
            });
        }
    });
});
