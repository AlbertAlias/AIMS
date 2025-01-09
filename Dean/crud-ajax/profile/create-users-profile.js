$(document).ready(function() {
    $('#user-profile').click(function() {
        $('#profile-picture-input').click(); 
    });

    $('#profile-picture-input').change(function() {
        var formData = new FormData();
        var file = $('#profile-picture-input')[0].files[0];
        formData.append('profile_picture', file);

        var userId = $('#user-profile').data('user-id');
        formData.append('user_id', userId);

        $.ajax({
            url: 'controller/profile/create-upload-profile.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var jsonResponse = JSON.parse(response);
                if (jsonResponse.success) {
                    retrieveProfilePicture(userId);
                } else {
                    console.error("Error: " + jsonResponse.error);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(textStatus, errorThrown);
            }
        });
    });
});