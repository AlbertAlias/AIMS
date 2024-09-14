document.addEventListener('DOMContentLoaded', function () {
    const contactNumberInput = document.getElementById('contactNumber');

    if (contactNumberInput) {
        contactNumberInput.addEventListener('input', function (e) {
            // Only allow numbers
            let value = e.target.value.replace(/\D/g, '');
            
            // Limit to 10 digits
            if (value.length > 10) {
                value = value.slice(0, 10);
            }

            // Ensure the first digit is not '0'
            if (value.length > 0 && value.charAt(0) === '0') {
                value = value.slice(1); // Remove the leading '0'
            }

            // Update the input value
            e.target.value = value;
        });
    }
});
