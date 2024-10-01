

// let isUpdating = false;

// if (document.getElementById('internsForm')) {
//     function showUpdateButton() {
//         const internUpdateBtn = document.getElementById('internUpdateBtn');
//         const internCancelBtn = document.getElementById('internCancelBtn');
//         const internSubmitBtn = document.getElementById('internSubmitBtn');

//         if (internUpdateBtn) {
//             internUpdateBtn.style.display = 'inline-block';
//             internUpdateBtn.disabled = false; // Initially enable the button
//         }

//         if (internCancelBtn) {
//             internCancelBtn.style.display = 'inline-block';
//             internCancelBtn.disabled = false; // Initially enable the button
//         }

//         if (internSubmitBtn) internSubmitBtn.style.display = 'none';
//     }

//     function toggleUpdateButton() {
//         if (!isUpdating) return;

//         const requiredFields = [
//             '#intern_last_name',
//             '#intern_first_name',
//             '#intern_gender',
//             '#intern_address',
//             '#intern_birthdate',
//             '#intern_civil_status',
//             '#intern_personal_email',
//             '#intern_contact_number',
//             '#studentID',
//             '#intern_department',
//             '#coordinator_name',
//             '#hours_needed',
//             '#coordinator_email',
//             '#internship_status'
//         ];

//         const internUpdateBtn = document.getElementById('internUpdateBtn');
//         const internCancelBtn = document.getElementById('internCancelBtn');
//         let allFilled = requiredFields.every(selector => $(selector).val().trim() !== '');

//         internUpdateBtn.disabled = !allFilled; // Disable button if any required field is empty
//         internCancelBtn.disabled = !allFilled; // Disable cancel button if any required field is empty
//     }

//     function unlockAndResetForms() {
//         const internsForm = document.getElementById('internsForm');
//         const intern_accountForm = document.getElementById('intern_accountForm');

//         if (internsForm) {
//             internsForm.reset();
//             document.querySelectorAll('#internsForm input, #internsForm select').forEach(el => {
//                 el.disabled = false;
//                 $(el).on('input change', toggleUpdateButton); // Add event listeners
//             });
//         }

//         if (intern_accountForm) {
//             intern_accountForm.reset();
//             document.querySelectorAll('#intern_accountForm input').forEach(el => el.disabled = false);
//         }

//         const internDepartmentSelect = document.getElementById('intern_department');
//         if (internDepartmentSelect) {
//             internDepartmentSelect.disabled = false; // Unlock the department select
//             internDepartmentSelect.selectedIndex = 0; // Reset to default option
//         }

//         const internSubmitBtn = document.getElementById('internSubmitBtn');
//         const internCancelBtn = document.getElementById('internCancelBtn');
//         const internUpdateBtn = document.getElementById('internUpdateBtn');

//         if (internSubmitBtn) {
//             internSubmitBtn.disabled = false;
//             internSubmitBtn.style.display = 'inline-block';
//         }

//         if (internCancelBtn) {
//             internCancelBtn.style.display = 'inline-block'; // Show the cancel button
//             internCancelBtn.disabled = false; // Enable the cancel button
//         }

//         toggleUpdateButton(); // Check button state when unlocking
//     }

//     function resetAndLockForms() {
//         const internsForm = document.getElementById('internsForm');
//         const intern_accountForm = document.getElementById('intern_accountForm');

//         // Reset and disable the interns form
//         if (internsForm) {
//             internsForm.reset();
//             document.querySelectorAll('#internsForm input, #internsForm select').forEach(el => el.disabled = true);
//         }

//         // Reset and disable the account form
//         if (intern_accountForm) {
//             intern_accountForm.reset();
//             document.querySelectorAll('#intern_accountForm input').forEach(el => el.disabled = true);
//         }

//         const internDepartmentSelect = document.getElementById('intern_department');
//         if (internDepartmentSelect) {
//             internDepartmentSelect.selectedIndex = 0; // Reset to default option
//             internDepartmentSelect.disabled = true; // Lock the department select
//         }

//         // Handle buttons' visibility and state
//         const internSubmitBtn = document.getElementById('internSubmitBtn');
//         const internCancelBtn = document.getElementById('internCancelBtn');
//         const internUpdateBtn = document.getElementById('internUpdateBtn');

//         if (internUpdateBtn) {
//             internUpdateBtn.style.display = 'none';
//         }

//         if (internSubmitBtn) {
//             internSubmitBtn.disabled = true; // Keep the submit button disabled
//             internSubmitBtn.style.display = 'inline-block'; // Show the submit button
//         }

//         if (internCancelBtn) {
//             internCancelBtn.style.display = 'none'; // Hide the cancel button after form lock
//         }
//     }

//     document.addEventListener('DOMContentLoaded', function() {
//         resetAndLockForms();
//     });

//     document.getElementById('addInternsBtn').addEventListener('click', function() {
//         unlockAndResetForms();

//         isUpdating = false;
//         const internUpdateBtn = document.getElementById('internUpdateBtn');
//         const internSubmitBtn = document.getElementById('internSubmitBtn');

//         if (internUpdateBtn) internUpdateBtn.style.display = 'none';
//         if (internSubmitBtn) internSubmitBtn.style.display = 'inline-block';
//     });

//     document.getElementById('internsInfo').addEventListener('click', function(event) {
//         if (event.target && event.target.matches('button[data-id]')) {
//             unlockAndResetForms();
//             showUpdateButton();
//             isUpdating = true;
//         }
//     });

//     // Event listener for the cancel button
//     const internCancelBtn = document.getElementById('internCancelBtn');
//     if (internCancelBtn) {
//         internCancelBtn.addEventListener('click', function() {
//             resetAndLockForms(); // Lock the form when cancel button is clicked
//         });
//     }

//     // Initialize toggleUpdateButton on form inputs
//     document.querySelectorAll('#internsForm input, #internsForm select').forEach(el => {
//         $(el).on('input change', toggleUpdateButton);
//     });
// }