document.addEventListener("DOMContentLoaded", function () {
    let ajaxRequestMade = false; // Flag to track if the request has already been made
    
    if (!ajaxRequestMade) {
        ajaxRequestMade = true; // Set flag to true once request is initiated
        $.ajax({
            url: 'controller/profile/retrieve-admin-initials.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                console.log(response);
                
                if (response.first_name && response.last_name) {
                    let firstName = response.first_name;
                    let lastName = response.last_name;
                    let initials = (firstName[0] + lastName[0]).toUpperCase();
                    let backgroundColor = generateRandomColor(firstName + lastName);
    
                    // Set the profile initials in the navbar
                    $('#profile-initials').text(initials).css('background-color', backgroundColor);
                    
                    // Also display initials in the dashed-border if no picture is uploaded
                    $('#profile-initials-placeholder').text(initials)
                        .css('background-color', backgroundColor)
                        .css('display', 'flex')  // Ensure it's displayed as a flex container
                        .css('align-items', 'center')  // Center the content vertically
                        .css('justify-content', 'center') // Center the content horizontally
                        .css('width', '155px') // Adjust as needed for sizing
                        .css('height', '145px') // Adjust as needed for sizing
                        .css('border-radius', '50%') // Make it circular
                        .css('color', 'white')
                        .css('font-size', '24px');
                    
                    // Hide the placeholder if there is a picture (add your logic for checking picture upload)
                    // e.g., if (hasProfilePicture) { $('#profile-initials-placeholder').hide(); }
                } else {
                    console.error('Error fetching user details:', response.error);
                }
            },
            error: function () {
                console.error('AJAX request failed');
            }
        });
    }
});

// Function to generate a random color based on a string
function generateRandomColor(string) {
    let hash = 0;
    for (let i = 0; i < string.length; i++) {
        hash = string.charCodeAt(i) + ((hash << 5) - hash);
    }
    
    let color = '#';
    for (let i = 0; i < 3; i++) {
        let value = (hash >> (i * 8)) & 0xFF;
        color += ('00' + value.toString(16)).slice(-2);
    }
    return color;
}