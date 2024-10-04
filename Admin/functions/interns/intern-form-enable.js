document.getElementById("addInternsBtn").addEventListener("click", function() {
    const internsForm = document.getElementById("internsForm");
    const inputs = internsForm.querySelectorAll("input, select");
    
    inputs.forEach(input => {
        input.value = '';
        input.disabled = false;
    });

    internsForm.reset();
    
    document.getElementById("internCancelBtn").style.display = "inline-block";
    document.getElementById("internSubmitBtn").disabled = false;
});

document.getElementById("internCancelBtn").addEventListener("click", function() {
    const internsForm = document.getElementById("internsForm");
    const inputs = internsForm.querySelectorAll("input, select");
    
    inputs.forEach(input => {
        input.value = '';
        input.disabled = true;
    });
    
    const accountForm = document.getElementById("intern_accountForm");
    const accountInputs = accountForm.querySelectorAll("input");

    accountInputs.forEach(input => {
        input.value = '';
    });

    document.getElementById("internCancelBtn").style.display = "none";
    document.getElementById("internSubmitBtn").disabled = true;
});

function resetAndDisableInternForm() {
    const internsForm = document.getElementById("internsForm");
    const accountForm = document.getElementById("intern_accountForm");

    // Disable all input and select elements in the interns form
    const internsInputs = internsForm.querySelectorAll("input, select");
    internsInputs.forEach(input => {
        input.disabled = true;
    });
    internsForm.reset();

    // Clear and disable all input elements in the account form
    const accountInputs = accountForm.querySelectorAll("input");
    accountInputs.forEach(input => {
        input.value = '';
        input.disabled = true;
    });

    document.getElementById("intern_account_email").disabled = true;
    document.getElementById("intern_password").disabled = true;

    document.getElementById("internCancelBtn").style.display = "none";
    document.getElementById("internSubmitBtn").disabled = true;
}
