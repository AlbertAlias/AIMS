$(document).ready(function() {
    let userId = $('#user-profile').data('user-id');
    retrieveProfilePicture(userId);
});

function retrieveProfilePicture(userId) {
    $.ajax({
        url: 'controller/profile/retrieve-profile-picture.php',
        type: 'GET',
        data: { user_id: userId },
        dataType: 'json',
        success: function(response) {
            if (response && response.profile_picture) {
                let imagePath = 'controller/profile/uploads/' + response.profile_picture;
                
                $('#default-profile-icon').hide();
                $('#profile-picture').attr('src', imagePath).show();
                $('#profile-container svg').hide();
                $('#profile-container').css({
                    'background-image': 'url(' + imagePath + ')',
                    'background-size': 'cover',
                    'background-position': 'center center'
                });
            } else {
                $('#default-profile-icon').show();
                $('#profile-picture').hide();
                $('#profile-container svg').show();
                $('#profile-container').css('background-image', 'none');
            }
        },
        error: function() {
            console.error('AJAX request failed to retrieve profile picture');
        }
    });
}