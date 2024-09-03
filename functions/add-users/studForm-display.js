// document.addEventListener('DOMContentLoaded', function() {
//     // Initially disable all input fields in the student form
//     const studentForm = document.getElementById('studentForm');
//     studentForm.style.display = 'block'; // Show the student form by default
//     studentForm.querySelectorAll('input, select, button').forEach(el => el.disabled = true);

//     // Add event listeners to all radio buttons
//     document.querySelectorAll('input[name="userRole"]').forEach(radio => {
//         radio.addEventListener('change', function() {
//             // Hide all forms initially
//             document.getElementById('studentForm').style.display = 'none';
//             document.getElementById('coordinatorForm').style.display = 'none';
//             document.getElementById('supervisorForm').style.display = 'none';
//             document.getElementById('registrarForm').style.display = 'none';

//             // Enable the student form fields if any role is selected
//             studentForm.querySelectorAll('input, select, button').forEach(el => el.disabled = false);

//             // Get the selected role and display the corresponding form
//             const selectedRole = document.querySelector('input[name="userRole"]:checked').value;

//             if (selectedRole === 'OJT Student') {
//                 document.getElementById('studentForm').style.display = 'block';
//             } else if (selectedRole === 'OJT Coordinator') {
//                 document.getElementById('coordinatorForm').style.display = 'block';
//             } else if (selectedRole === 'OJT Supervisor') {
//                 document.getElementById('supervisorForm').style.display = 'block';
//             } else if (selectedRole === 'Registrar') {
//                 document.getElementById('registrarForm').style.display = 'block';
//             }
//         });
//     });
// });

document.addEventListener('DOMContentLoaded', function() {
    // Get the student form element
    const studentForm = document.getElementById('studentForm');
    if (studentForm) {
        studentForm.style.display = 'block'; // Show the student form by default
        studentForm.querySelectorAll('input, select, button').forEach(el => el.disabled = true);
    }

    // Add event listeners to all radio buttons
    document.querySelectorAll('input[name="userRole"]').forEach(radio => {
        radio.addEventListener('change', function() {
            // Hide all forms initially
            ['studentForm', 'coordinatorForm', 'supervisorForm', 'registrarForm'].forEach(formId => {
                const form = document.getElementById(formId);
                if (form) {
                    form.style.display = 'none';
                }
            });

            // Enable the student form fields if any role is selected
            if (studentForm) {
                studentForm.querySelectorAll('input, select, button').forEach(el => el.disabled = false);
            }

            // Get the selected role and display the corresponding form
            const selectedRole = document.querySelector('input[name="userRole"]:checked')?.value;

            if (selectedRole) {
                const formToShow = document.getElementById(`${selectedRole.replace(' ', '').toLowerCase()}Form`);
                if (formToShow) {
                    formToShow.style.display = 'block';
                }
            }
        });
    });
});