$(document).on('click', '.deleteButton', function () {
    const userId = $(this).data('user-id');

    if (confirm('Are you sure you want to delete this user and all related data?')) {
        $.ajax({
            url: 'controller/masterlists/archive-users.php', // Change this to your PHP script file
            type: 'POST',
            data: {
                delete_user_id: userId
            },
            success: function (response) {
                const data = JSON.parse(response);
                if (data.status === 'success') {
                    alert(data.message);
                    location.reload(); // Reload the page to reflect changes
                } else {
                    alert(data.message);
                }
            }
        });
    }
});