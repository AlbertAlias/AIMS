$("#submitDocumentForm").on("submit", function (e) {
  e.preventDefault();
  
  const formData = new FormData(this); // Automatically gathers file data.

  $.ajax({
      url: "controller/requirement/create-submit-requirements.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (result) {
          if (result.success) {
              Swal.fire({
                  icon: "success",
                  title: "Success",
                  text: "File submitted successfully.",
              });
              $("#submitDocumentForm")[0].reset();
              const modal = bootstrap.Modal.getInstance(document.getElementById("submitDocumentModal"));
              modal.hide();
          } else {
              Swal.fire({
                  icon: "error",
                  title: "Error",
                  text: result.error || "Unexpected error occurred.",
              });
          }
      },
      error: function (xhr, status, error) {
          console.error("AJAX Error", error);
          Swal.fire({
              icon: "error",
              title: "Unexpected Error",
              text: "Error while processing the form.",
          });
      }
  });
});