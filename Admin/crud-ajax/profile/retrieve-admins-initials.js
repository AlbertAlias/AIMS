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
                
                if (response && response.first_name && response.last_name) {
                    let firstName = response.first_name;
                    let lastName = response.last_name;
                    let initials = (firstName[0] + lastName[0]).toUpperCase();
                    let backgroundColor = getRandomColor(); // Change this line
                
                    // Set the profile initials in the navbar
                    $('#profile-initials').text(initials).css('background-color', backgroundColor);
                
                    // Set initials in the placeholder
                    $('#profile-initials-placeholder').text(initials)
                        .css('background-color', backgroundColor)
                        .css('display', 'flex')
                        .css('align-items', 'center')
                        .css('justify-content', 'center')
                        .css('width', '148px')
                        .css('height', '145px')
                        .css('border-radius', '50%')
                        .css('color', 'white')
                        .css('font-size', '64px');
                } else {
                    console.error('No user found or user data is incomplete');
                }
            },
            error: function () {
                console.error('AJAX request failed');
            }
        });
    }
});

// Function to get a random color from a predefined set of darker colors
function getRandomColor() {
    const colors = ['red', 'blue', 'green', '#FF4500', '#800080', '#FF00FF', '#D3A300']; // Mustard Yellow
    const randomIndex = Math.floor(Math.random() * colors.length);
    return colors[randomIndex];
}