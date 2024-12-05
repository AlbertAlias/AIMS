document.addEventListener('DOMContentLoaded', function() {
    // Get the form fields
    const lastNameInput = document.getElementById('coor_last_name');
    const firstNameInput = document.getElementById('coor_first_name');
    const coorCodeInput = document.getElementById('coor_code');

    // Function to update the coordinator code based on initials
    function updateCoorCode() {
        const lastNameInitial = lastNameInput.value ? lastNameInput.value.charAt(0).toUpperCase() : '';
        const firstNameInitial = firstNameInput.value ? firstNameInput.value.charAt(0).toUpperCase() : '';
        coorCodeInput.value = lastNameInitial + firstNameInitial;
    }

    // Attach event listeners to update the coor_code whenever first or last name changes
    lastNameInput.addEventListener('input', updateCoorCode);
    firstNameInput.addEventListener('input', updateCoorCode);

    // Disable the coor_code input so it cannot be edited manually
    coorCodeInput.disabled = true;
});