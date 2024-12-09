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
          title: "Incomplete",
          text: "Please fill out all fields.",
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
            title: "Posted",
            text: result.message,
          });

          postRequirementsForm.reset();
          const postModal = new bootstrap.Modal(document.getElementById("postRequirementsModal"));
          postModal.hide();
        } else {
          Swal.fire({
            icon: "error",
            title: "Failed",
            text: result.error,
          });
        }
      } catch (error) {
        console.error("Unexpected JS error: ", error);
        Swal.fire({
          icon: "error",
          title: "Unexpected Error",
          text: "Please try again later.",
        });
      }
    });
  }
});
