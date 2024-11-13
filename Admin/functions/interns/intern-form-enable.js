function internBtnFormToggle(isEnabled) {
    const internsForm = document.getElementById("internsForm");
    const inputs = internsForm.querySelectorAll("input, select");

    // Reset values if disabling the form
    if (!isEnabled) {
        inputs.forEach(input => {
            input.value = ''; // Clear values
            input.disabled = true; // Disable all fields
        });

        // Reset selects to default
        const selects = internsForm.querySelectorAll("select");
        selects.forEach(select => {
            select.selectedIndex = 0; // Set selected index to the first option
        });

        // Reset account email and password fields
        document.getElementById("intern_account_email").value = '';
        document.getElementById("intern_password").value = '';
    } else {
        // Enable fields except account email and password
        inputs.forEach(input => {
            if (input !== document.getElementById("intern_account_email") && input !== document.getElementById("intern_password")) {
                input.disabled = false; // Enable other fields
            }
        });
    }

    // Show/Hide buttons based on whether the form is enabled or not
    document.getElementById("internCancelBtn").style.display = isEnabled ? "inline-block" : "none";
    document.getElementById("interUpdateBtn").style.display = isEnabled ?  "none" : "inline-block";
    document.getElementById("internUpdateBtn").disabled = !isEnabled;
}

function updateFormResetAndLock() {
    const internsForm = document.getElementById("internsForm");
    const inputs = internsForm.querySelectorAll("input, select");

    // Reset and lock unlocked fields in the internsForm
    inputs.forEach(input => {
        if (!input.disabled) {
            input.value = ''; // Clear the value
            input.disabled = true; // Lock the field
        }
    });

    // Reset values in the intern_accountForm
    const accountForm = document.getElementById("intern_accountForm");
    const accountInputs = accountForm.querySelectorAll("input");

    accountInputs.forEach(input => {
        input.value = ''; // Clear the value in account form
    });

    document.getElementById("internCancelBtn").style.display = "none";
    document.getElementById("internUpdpateBtn").style.display = "inline-block";
    document.getElementById("internUpdateBtn").disabled = true;
}

function preventRemoveUpdate() {
    const requiredFields = document.querySelectorAll("#internsForm input[required], #internsForm select[required]");
    let allFieldsFilled = true;

    // Check if any required field is empty
    requiredFields.forEach(field => {
        if (!field.value || field.value === "Choose Gender" || field.value === "Choose Status" || field.value === "Choose Department") {
            allFieldsFilled = false;
        }
    });

    // Enable or disable the Update button based on the field's values
    const updateBtn = document.getElementById("internUpdateBtn");
    updateBtn.disabled = !allFieldsFilled;
}

// Add event listeners to required fields to check on input change
function setupFieldListeners() {
    const requiredFields = document.querySelectorAll("#internsForm input[required], #internsForm select[required]");
    
    requiredFields.forEach(field => {
        field.addEventListener("input", preventRemoveUpdate);
        field.addEventListener("change", preventRemoveUpdate);  // For select fields
    });
}

// Call this function when the form is loaded or populated with intern data
setupFieldListeners();

document.getElementById("internCancelBtn").addEventListener("click", function() {
    const internsForm = document.getElementById("internsForm");
    const inputs = internsForm.querySelectorAll("input, select");

    // Reset values on cancel
    inputs.forEach(input => {
        input.value = '';
        input.disabled = true; // Disable all form inputs on cancel
    });

    // Reset account fields
    const accountForm = document.getElementById("intern_accountForm");
    const accountInputs = accountForm.querySelectorAll("input");

    accountInputs.forEach(input => {
        input.value = '';
    });

    // Reset selects to default
    const selects = internsForm.querySelectorAll("select");
    selects.forEach(select => {
        select.selectedIndex = 0; // Set selected index to the first option
    });

    document.getElementById("internCancelBtn").style.display = "none";
    document.getElementById("internUpdateBtn").style.display = "inline-block";
    document.getElementById("internUpdateBtn").disabled = true;
});