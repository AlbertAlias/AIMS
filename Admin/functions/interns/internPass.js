// Function to update the password field based on birthdate
function updatePasswordFromBirthdate() {
    const birthdateInput = document.getElementById('intern_birthdate');
    const passwordInput = document.getElementById('intern_password');

    if (birthdateInput && passwordInput) {
        const birthdate = new Date(birthdateInput.value);
        if (!isNaN(birthdate)) {
            const day = String(birthdate.getDate()).padStart(2, '0');
            const month = String(birthdate.getMonth() + 1).padStart(2, '0');
            const year = birthdate.getFullYear();
            passwordInput.value = `${day}${month}${year}`; // Concatenate without slashes
        } else {
            passwordInput.value = ''; // Reset if birthdate is invalid
        }
    }
}

// Add event listener for birthdate change
document.getElementById('intern_birthdate').addEventListener('change', updatePasswordFromBirthdate);