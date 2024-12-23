$(document).ready(function() {
    // Dynamically retrieve and display the uploaded profile picture on page load
    let userId = $('#user-profile').data('user-id'); // Get user ID from the camera icon's data attribute
    retrieveProfilePicture(userId);
});

// Function to retrieve and display the profile picture
function retrieveProfilePicture(userId) {
    $.ajax({
        url: 'controller/profile/retrieve-profile-picture.php',
        type: 'GET',
        data: { user_id: userId },
        dataType: 'json',
        success: function(response) {
            if (response && response.profile_picture) {
                // Construct the image path
                let imagePath = 'controller/profile/uploads/' + response.profile_picture;
                
                // Profile Picture in main profile page
                $('#default-profile-icon').hide(); // Hide the default icon in main profile
                $('#profile-picture').attr('src', imagePath).show(); // Show uploaded picture
                
                // Profile Picture in header
                $('#profile-container svg').hide(); // Hide the default SVG placeholder in the header
                $('#profile-container').css({
                    'background-image': 'url(' + imagePath + ')',
                    'background-size': 'cover',
                    'background-position': 'center center'
                });
            } else {
                // Hide profile picture and display default styling/icons
                $('#default-profile-icon').show(); // Show default icon if no picture is found
                $('#profile-picture').hide(); // Hide profile picture if not available

                // Default header icon and no background
                $('#profile-container svg').show();
                $('#profile-container').css('background-image', 'none');
            }
        },
        error: function() {
            console.error('AJAX request failed to retrieve profile picture');
        }
    });
}