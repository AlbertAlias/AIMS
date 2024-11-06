document.addEventListener("DOMContentLoaded", function() {
    // Get modal and input elements
    const editModal = new bootstrap.Modal(document.getElementById("editModal"));
    const editInput = document.getElementById("editInput");

    // Add click listeners for each edit button
    document.getElementById("namEditBtn").addEventListener("click", function() {
        editModal.show();
        editInput.value = document.getElementById("users-name").textContent;
        document.getElementById("editModalLabel").textContent = "Edit Name";
    });

    document.getElementById("locEditBtn").addEventListener("click", function() {
        editModal.show();
        editInput.value = document.getElementById("users-location").textContent;
        document.getElementById("editModalLabel").textContent = "Edit Location";
    });

    document.getElementById("civilEditBtn").addEventListener("click", function() {
        editModal.show();
        editInput.value = document.getElementById("users-civil-status").textContent;
        document.getElementById("editModalLabel").textContent = "Edit Civil Status";
    });

    document.getElementById("emailEditBtn").addEventListener("click", function() {
        editModal.show();
        editInput.value = document.getElementById("users-email").textContent;
        document.getElementById("editModalLabel").textContent = "Edit Email";
    });

    // Save changes from the modal
    document.getElementById("saveEditBtn").addEventListener("click", function() {
        // Get updated value
        const updatedValue = editInput.value;

        // Use a switch case or if-else to update the appropriate field
        // Here you might want to save the updated value to the backend using an AJAX request
        editModal.hide();
    });
});
