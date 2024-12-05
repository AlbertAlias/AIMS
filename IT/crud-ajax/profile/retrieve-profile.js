$(document).ready(function() {
    // Dynamically retrieve and display the uploaded profile picture on page load
    let userId = $('#user-profile').data('user-id'); // Get user ID from the camera icon's data attribute
    retrieveProfilePicture(userId);
});

// Function to retrieve and display the profile picture
function retrieveProfilePicture(userId) {
    $.ajax({
        url: 'controller/profile/retrieve-profile-picture.php', // PHP file to retrieve the uploaded profile picture
        type: 'GET',
        data: { user_id: userId }, // Send the user ID as data
        dataType: 'json',
        success: function(response) {
            if (response && response.profile_picture) {
                // Construct the image path
                let imagePath = 'controller/profile/uploads/' + response.profile_picture;
                
                // Profile Picture in main profile page
                $('#default-profile-icon').hide(); // Hide the default icon in main profile
                $('#profile-picture').attr('src', imagePath).show(); // Show uploaded picture
                
                // Profile Picture in header
                $('#default-header-icon').hide(); // Hide the default header icon
                $('#profile-container').css({
                    'background-image': 'url(' + imagePath + ')',
                    'background-size': 'cover',
                    'background-position': 'center center'
                });
            } else {
                console.warn('No profile picture found, displaying initials instead.');
                $('#default-profile-icon').show(); // Show default icon if no picture is found
                $('#profile-picture').hide(); // Hide profile picture if not available

                // Show default icon in header if no picture
                $('#default-header-icon').show();
                $('#profile-container').css('background-image', 'none'); // Remove background if no image
            }
        },
        error: function() {
            console.error('AJAX request failed to retrieve profile picture');
        }
    });
}