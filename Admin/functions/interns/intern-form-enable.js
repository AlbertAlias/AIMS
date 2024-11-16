document.addEventListener("DOMContentLoaded", function () {
    const internsForm = document.getElementById("internsForm");
    const internCancelBtn = document.getElementById("internCancelBtn");
    const internUpdateBtn = document.getElementById("internUpdateBtn");
    const internsInfo = document.getElementById("internsInfo");

    // Enable all inputs and selects in the form
    function enableFormInputs() {
        const inputs = internsForm.querySelectorAll("input, select");
        inputs.forEach((input) => {
            input.disabled = false; // Enable inputs and selects
        });
        internUpdateBtn.disabled = false; // Enable update button
    }

    // Disable all inputs and selects in the form
    function disableFormInputs() {
        const inputs = internsForm.querySelectorAll("input, select");
        inputs.forEach((input) => {
            input.disabled = true; // Disable inputs and selects
        });
        internUpdateBtn.disabled = true; // Disable update button
    }

    // Reset the form inputs and selects to their default state
    function resetFormInputs() {
        const inputs = internsForm.querySelectorAll("input, select");
        inputs.forEach((input) => {
            if (input.tagName === "SELECT") {
                input.selectedIndex = 0; // Reset selects to the first option
            } else {
                input.value = ""; // Clear text, email, date, etc.
            }
        });
    }

    // Populate the form fields with the selected intern's data
    function populateForm(intern) {
        document.getElementById("internID").value = intern.id || "";
        document.getElementById("intern_intern_id").value = intern.intern_id || "";
        document.getElementById("intern_last_name").value = intern.last_name || "";
        document.getElementById("intern_first_name").value = intern.first_name || "";
        document.getElementById("intern_gender").value = intern.gender || "";
        document.getElementById("studentID").value = intern.student_id || "";
        document.getElementById("intern_department").value = intern.department_id || "";
        document.getElementById("intern_username").value = intern.username || "";
        document.getElementById("intern_password").value = intern.password || "";
    }

    // Event delegation to handle clicks on dynamically generated intern buttons
    internsInfo.addEventListener("click", function (e) {
        if (e.target.classList.contains("intern-btn")) {
            const internId = e.target.getAttribute("data-id");

            // Simulate fetching intern data from `window.interns` or server
            const intern = window.interns.find((intern) => intern.id == internId);

            if (intern) {
                populateForm(intern); // Populate form with intern data
                enableFormInputs(); // Enable form inputs
                internCancelBtn.style.display = "inline-block"; // Show cancel button
            }
        }
    });

    // Cancel button functionality
    internCancelBtn.addEventListener("click", function () {
        resetFormInputs(); // Reset form inputs to their default state
        disableFormInputs(); // Disable form inputs
        internCancelBtn.style.display = "none"; // Hide cancel button
    });

    // Initial state
    disableFormInputs();
    internCancelBtn.style.display = "none"; // Hide cancel button by default
});