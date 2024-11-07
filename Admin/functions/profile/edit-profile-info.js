document.addEventListener("DOMContentLoaded", function() {
    const editModal = new bootstrap.Modal(document.getElementById("editModal"));
    const lastNameInput = document.getElementById("lastName");
    const firstNameInput = document.getElementById("firstName");
    const middleNameInput = document.getElementById("middleName");
    const locationInput = document.getElementById("locationInput");
    const civilStatusInput = document.getElementById("civilStatusInput");
    const emailInput = document.getElementById("emailInput");

    // Hide all fields initially
    function hideAllFields() {
        document.getElementById("nameFields").style.display = "none";
        document.getElementById("locationField").style.display = "none";
        document.getElementById("civilStatusField").style.display = "none";
        document.getElementById("emailField").style.display = "none";
    }

    // Name Edit Button
    document.getElementById("namEditBtn").addEventListener("click", function() {
        hideAllFields();
        document.getElementById("nameFields").style.display = "block";
        editModal.show();
        
        // Set current values
        const nameParts = document.getElementById("users-name").textContent.split(" ");
        lastNameInput.value = nameParts[0] || "";
        firstNameInput.value = nameParts[1] || "";
        middleNameInput.value = nameParts[2] || "";

        document.getElementById("editModalLabel").textContent = "Edit Name";
    });

    // Location Edit Button
    document.getElementById("locEditBtn").addEventListener("click", function() {
        hideAllFields();
        document.getElementById("locationField").style.display = "block";
        editModal.show();

        locationInput.value = document.getElementById("users-location").textContent;
        document.getElementById("editModalLabel").textContent = "Edit Location";
    });

    // Civil Status Edit Button
    document.getElementById("civilEditBtn").addEventListener("click", function() {
        hideAllFields();
        document.getElementById("civilStatusField").style.display = "block";
        editModal.show();

        civilStatusInput.value = document.getElementById("users-civil-status").textContent;
        document.getElementById("editModalLabel").textContent = "Edit Civil Status";
    });

    // Email Edit Button
    document.getElementById("emailEditBtn").addEventListener("click", function() {
        hideAllFields();
        document.getElementById("emailField").style.display = "block";
        editModal.show();

        emailInput.value = document.getElementById("users-email").textContent;
        document.getElementById("editModalLabel").textContent = "Edit Email";
    });

    // Save changes from the modal
    document.getElementById("saveEditBtn").addEventListener("click", function() {
        const updatedLastName = lastNameInput.value;
        const updatedFirstName = firstNameInput.value;
        const updatedMiddleName = middleNameInput.value;
        const updatedLocation = locationInput.value;
        const updatedCivilStatus = civilStatusInput.value;
        const updatedEmail = emailInput.value;

        // Send the data to the backend or update the fields as needed
        console.log("Updated Data:", {
            lastName: updatedLastName,
            firstName: updatedFirstName,
            middleName: updatedMiddleName,
            location: updatedLocation,
            civilStatus: updatedCivilStatus,
            email: updatedEmail
        });

        // Close the modal
        editModal.hide();
    });
});
