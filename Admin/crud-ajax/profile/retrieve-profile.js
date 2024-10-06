$(document).ready(function() {
    // Dynamically retrieve and display the uploaded profile picture on page load
    let userId = $('#camera-icon').data('user-id'); // Get user ID from the camera icon's data attribute
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
            if (response.profile_picture) {
                // Hide initials placeholder
                $('#profile-initials-placeholder').hide();
                
                // Construct the image path
                let imagePath = 'controller/profile/uploads/' + response.profile_picture;
                
                // Update the profile picture on the profile page
                $('#profile-picture').attr('src', imagePath).show();
                
                // Also update the profile picture in the navbar
                $('#profile-initials').css({
                    'background-image': 'url(' + imagePath + ')',
                    'background-size': 'cover',
                    'background-position': 'center center',
                    'color': 'transparent' // Hide the initials text
                });
            } else {
                console.error('Error fetching profile picture:', response.error);
            }
        },
        error: function() {
            console.error('AJAX request failed to retrieve profile picture');
        }
    });
}