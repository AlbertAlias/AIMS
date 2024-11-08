$(document).ready(function() {
    // Trigger file input click on camera icon click
    $('#user-profile').click(function() {
        $('#profile-picture-input').click(); 
    });

    // Handle file selection
    $('#profile-picture-input').change(function() {
        var formData = new FormData();
        var file = $('#profile-picture-input')[0].files[0];
        formData.append('profile_picture', file);

        // Dynamically get the user ID from the camera icon's data attribute
        var userId = $('#user-profile').data('user-id');
        console.log("User ID:", userId); // Debugging log
        formData.append('user_id', userId); // Use the user ID

        $.ajax({
            url: 'controller/profile/create-upload-profile.php', // PHP file to handle upload
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var jsonResponse = JSON.parse(response);
                if (jsonResponse.success) {
                    // Call the retrieve function to update the profile picture
                    retrieveProfilePicture(userId);
                } else {
                    console.error("Error: " + jsonResponse.error); // Handle error response
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(textStatus, errorThrown); // Handle AJAX errors
            }
        });
    });
});