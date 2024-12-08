document.addEventListener("DOMContentLoaded", function () {
  
  const postRequirementsForm = document.getElementById("postRequirementsForm");
  
  if (postRequirementsForm) {
    postRequirementsForm.addEventListener("submit", async function (e) {
      e.preventDefault();

      const requirementTitle = document.getElementById("requirementTitle").value.trim();
      const requirementDescription = document.getElementById("requirementDescription").value.trim();

      if (!requirementTitle || !requirementDescription) {
        Swal.fire({
          icon: "error",
          title: "Oops!",
          text: "Both fields are required.",
        });
        return;
      }

      try {
        const response = await fetch("controller/post_requirement.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: `requirementTitle=${encodeURIComponent(requirementTitle)}&requirementDescription=${encodeURIComponent(requirementDescription)}`,
        });

        const result = await response.json();

        if (result.success) {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: result.message,
          });
          postRequirementsForm.reset();
          const postRequirementsModal = new bootstrap.Modal(document.getElementById("postRequirementsModal"));
          postRequirementsModal.hide();
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: result.error,
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
