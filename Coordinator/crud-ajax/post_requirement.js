$(document).ready(function () {
  const postRequirementsForm = $("#postRequirementsForm");

  if (postRequirementsForm.length) {
    postRequirementsForm.on("submit", function (e) {
      e.preventDefault();

      const requirementTitle = $("#requirementTitle").val().trim();
      const requirementDescription = $("#requirementDescription").val().trim();

      if (!requirementTitle || !requirementDescription) {
        Swal.fire({
          icon: "error",
          title: "Incomplete",
          text: "Please fill out all fields.",
        });
        return;
      }

      $.ajax({
        url: "controller/post_requirement.php",
        type: "POST",
        data: {
          requirementTitle: requirementTitle,
          requirementDescription: requirementDescription,
        },
        dataType: "json",
        success: function (result) {
          if (result.success) {
            Swal.fire({
              icon: "success",
              title: "Posted",
              text: result.message,
            });

            postRequirementsForm[0].reset();
            const postModal = new bootstrap.Modal($("#postRequirementsModal")[0]);
            postModal.hide();
          } else {
            Swal.fire({
              icon: "error",
              title: "Failed",
              text: result.error,
            });
          }
        },
        error: function (xhr, status, error) {
          console.error("Unexpected JS error: ", error);
          Swal.fire({
            icon: "error",
            title: "Unexpected Error",
            text: "Please try again later.",
          });
        }
      });
    });
  }
});