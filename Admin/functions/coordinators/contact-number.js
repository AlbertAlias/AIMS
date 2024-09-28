document.addEventListener('DOMContentLoaded', function () {
    const contactNumberInput = document.getElementById('coor_contact_number');

    if (contactNumberInput) {
        contactNumberInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); // Only digits

            if (value.length > 10) {
                value = value.slice(0, 10);
            }

            if (value.charAt(0) === '0') {
                value = value.slice(1); // Prevent leading zero
            }

            e.target.value = value; // Update the input
        });
    }
});
