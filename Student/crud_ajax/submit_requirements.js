document.getElementById("submitDocumentForm").addEventListener("submit", async function (e) {
    e.preventDefault();
    
    const formData = new FormData(this); // Automatically gathers file data.
  
    try {
      const response = await fetch("controller/submit_documents.php", {
        method: "POST",
        body: formData,
      });
  
      const result = await response.json();
  
      if (result.success) {
        Swal.fire({
          icon: "success",
          title: "Success",
          text: "File submitted successfully.",
        });
        this.reset();
        const modal = bootstrap.Modal.getInstance(document.getElementById("submitDocumentModal"));
        modal.hide();
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: result.error || "Unexpected error occurred.",
        });
      }
    } catch (error) {
      console.error("AJAX Error", error);
      Swal.fire({
        icon: "error",
        title: "Unexpected Error",
        text: "Error while processing the form.",
      });
    }
  });
  