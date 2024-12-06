document.addEventListener("DOMContentLoaded", function () {
  
  // Handle the submission of the "Post Requirements" form
  const postRequirementsForm = document.getElementById("postRequirementsForm");
  
  if (postRequirementsForm) {
    postRequirementsForm.addEventListener("submit", async function (e) {
      e.preventDefault(); // Prevent default form submission
      
      // Collect form data
      const requirementTitle = document.getElementById("requirementTitle").value.trim();
      const requirementDescription = document.getElementById("requirementDescription").value.trim();
      
      // Validate form data
      if (!requirementTitle || !requirementDescription) {
        Swal.fire({
          icon: "error",
          title: "Oops!",
          text: "Both fields are required.",
        });
        return;
      }

      try {
        // Send the data to PHP endpoint
        const response = await fetch("controller/post_requirement.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: `requirementTitle=${encodeURIComponent(requirementTitle)}&requirementDescription=${encodeURIComponent(requirementDescription)}`,
        });

        const result = await response.json(); // Parse the server response as JSON

        if (result.success) {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: "Requirement posted successfully!",
          });
          // Reset the form after successful submission
          postRequirementsForm.reset();
          // Close the modal
          const postRequirementsModal = new bootstrap.Modal(document.getElementById("postRequirementsModal"));
          postRequirementsModal.hide();
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: result.error || "Something went wrong.",
          });
        }
      } catch (error) {
        console.error("Error submitting the form: ", error);
        Swal.fire({
          icon: "error",
          title: "Unexpected Error",
          text: "An unexpected error occurred. Please try again.",
        });
      }
    });
  }
  
});
