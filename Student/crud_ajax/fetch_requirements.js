// document.addEventListener("DOMContentLoaded", async function () {
//   const requirementsContainer = document.getElementById("requirementsContainer");

//   try {
//       const response = await fetch("controller/fetch_requirements.php");
//       const result = await response.json();

//       if (result.success) {
//           const requirements = result.data;

//           if (requirements.length === 0) {
//               requirementsContainer.innerHTML = `<p class="text-center">No requirements found.</p>`;
//               return;
//           }

//           // Render requirements
//           requirements.forEach((requirement) => {
//             const requirementCard = `
//                 <div class="card mb-3">
//                     <div class="card-header">
//                         <h5>${requirement.title}</h5>
//                     </div>
//                     <div class="card-body">
//                         <p>${requirement.description}</p>
//                         <p><small><strong>Posted:</strong> ${new Date(requirement.created_at).toLocaleString()}</small></p>
//                         <form class="submit-form" data-id="${requirement.id}">
//                             <input type="hidden" name="student_id" value="1"> <!-- Replace with dynamic student ID -->
//                             <input type="file" name="file" class="form-control mb-2" required>
//                             <button type="submit" class="btn btn-primary">Submit Requirement</button>
//                         </form>
//                     </div>
//                 </div>
//             `;
//             requirementsContainer.insertAdjacentHTML("beforeend", requirementCard);
//         });
//           // Attach event listener to forms
//           document.querySelectorAll(".submit-form").forEach((form) => {
//               form.addEventListener("submit", async function (e) {
//                   e.preventDefault();
//                   const requirementId = this.dataset.id;
//                   const studentId = this.querySelector("input[name='student_id']").value;
//                   const fileInput = this.querySelector("input[name='file']");

//                   const formData = new FormData();
//                   formData.append("requirement_id", requirementId);
//                   formData.append("student_id", studentId);
//                   formData.append("file", fileInput.files[0]);

//                   try {
//                       const response = await fetch("controller/submit_requirements.php", {
//                           method: "POST",
//                           body: formData,
//                       });

//                       const result = await response.json();
//                       if (result.success) {
//                           Swal.fire({
//                               icon: "success",
//                               title: "Success",
//                               text: "Requirement submitted successfully!",
//                           });
//                           this.reset();
//                       } else {
//                           Swal.fire({
//                               icon: "error",
//                               title: "Error",
//                               text: result.error || "Submission failed.",
//                           });
//                       }
//                   } catch (error) {
//                       console.error("Submission error: ", error);
//                       Swal.fire({
//                           icon: "error",
//                           title: "Unexpected Error",
//                           text: "An unexpected error occurred. Please try again.",
//                       });
//                   }
//               });
//           });
//       } else {
//           requirementsContainer.innerHTML = `<p class="text-center">Error fetching requirements.</p>`;
//       }
//   } catch (error) {
//       console.error("Error fetching requirements: ", error);
//       requirementsContainer.innerHTML = `<p class="text-center">An unexpected error occurred.</p>`;
//   }
// });


document.addEventListener("DOMContentLoaded", async function () {
    const requirementsContainer = document.getElementById("requirementsContainer");
  
    try {
      const result = await fetchRequirements();
      
      if (result.success) {
        const requirements = result.data;
        
        if (requirements.length === 0) {
          renderNoRequirements();
        } else {
          renderRequirements(requirements);
        }
      } else {
        renderError("Error fetching requirements.");
      }
    } catch (error) {
      console.error("Error fetching requirements: ", error);
      renderError("An unexpected error occurred.");
    }
  });
  
  /**
   * Fetch requirements from the server
   */
  async function fetchRequirements() {
    const response = await fetch("controller/fetch_requirements.php");
    return await response.json();
  }
  
  /**
   * Render a message when no requirements are found
   */
  function renderNoRequirements() {
    const requirementsContainer = document.getElementById("requirementsContainer");
    requirementsContainer.innerHTML = `<p class="text-center">No requirements found.</p>`;
  }
  
  /**
   * Render error message on failures
   */
  function renderError(message) {
    const requirementsContainer = document.getElementById("requirementsContainer");
    requirementsContainer.innerHTML = `<p class="text-center">${message}</p>`;
  }
  
  /**
   * Dynamically render the fetched requirements
   * @param {Array} requirements - List of fetched requirement objects
   */
  function renderRequirements(requirements) {
    const requirementsContainer = document.getElementById("requirementsContainer");
  
    requirements.forEach((requirement) => {
      const requirementCard = `

        <div card mb-3>
            <div>
                <div class="card-header">
                    <h5>${requirement.title}</h5>
                        </div>
                            <p>${requirement.description}</p>
                                <p><small><strong>Posted:</strong> ${new Date(requirement.created_at).toLocaleString()}</small></p>
                                    <div class="mb-3 position-relative">
                                <form class="submit-form" data-id="${requirement.id}">
                            <input type="hidden" name="student_id" value="1">
                        <input type="file" name="file" class="form-control mb-2" required>
                    <button type="submit" class="btn btn-primary">Submit Requirement</button>
                </form>
            </div>
        </div>
      `;
      requirementsContainer.insertAdjacentHTML("beforeend", requirementCard);
    });
  
    attachFormListeners();
  }
  
  /**
   * Attach event listeners to all dynamically created forms
   */
  function attachFormListeners() {
    const forms = document.querySelectorAll(".submit-form");
  
    forms.forEach((form) => {
      form.addEventListener("submit", handleFormSubmission);
    });
  }
  
  /**
   * Handle form submission logic
   */
  async function handleFormSubmission(e) {
    e.preventDefault();
    const form = e.target;
    const requirementId = form.dataset.id;
    const studentId = form.querySelector("input[name='student_id']").value;
    const fileInput = form.querySelector("input[name='file']");
  
    const formData = new FormData();
    formData.append("requirement_id", requirementId);
    formData.append("student_id", studentId);
    formData.append("file", fileInput.files[0]);
  
    try {
      const response = await fetch("controller/submit_requirements.php", {
        method: "POST",
        body: formData,
      });
  
      const result = await response.json();
      if (result.success) {
        Swal.fire({
          icon: "success",
          title: "Success",
          text: "Requirement submitted successfully!",
        });
        form.reset();
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: result.error || "Submission failed.",
        });
      }
    } catch (error) {
      console.error("Submission error: ", error);
      Swal.fire({
        icon: "error",
        title: "Unexpected Error",
        text: "An unexpected error occurred. Please try again.",
      });
    }
  }
  