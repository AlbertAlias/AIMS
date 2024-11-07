$(document).ready(function() {
    const editModal = new bootstrap.Modal(document.getElementById("editModal"));
    const lastNameInput = $("#lastName");
    const firstNameInput = $("#firstName");
    const middleNameInput = $("#middleName");
    const locationInput = $("#locationInput");
    const civilStatusInput = $("#civilStatusInput");
    const emailInput = $("#emailInput");
    const adminId = 1; // Replace with dynamic admin ID

    $("#saveEditBtn").on("click", function() {
        const updatedLastName = lastNameInput.val().trim();
        const updatedFirstName = firstNameInput.val().trim();
        const updatedMiddleName = middleNameInput.val().trim();
        const updatedLocation = locationInput.val().trim();
        const updatedCivilStatus = civilStatusInput.val().trim();
        const updatedEmail = emailInput.val().trim();

        // Prepare the data to be sent to the backend
        const data = {
            adminId: adminId,
            lastName: updatedLastName || '', // Include empty string if not updated
            firstName: updatedFirstName || '',
            middleName: updatedMiddleName || '',
            location: updatedLocation || '',
            civilStatus: updatedCivilStatus || '',
            email: updatedEmail || ''
        };

        // Send the data to the PHP script via AJAX
        $.ajax({
            url: 'controller/profile/update-admins-info.php', // PHP script for updating data
            type: 'POST',
            dataType: 'json', // Expecting JSON response
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function(response) {
                if (response.success) {
                    alert(response.success);
                    editModal.hide(); // Close modal
                } else {
                    alert(response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while updating.');
            }
        });
    });
});