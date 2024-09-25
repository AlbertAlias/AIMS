// Ensure the script runs only on the Sub-Admins page
if (document.getElementById('adminsForm')) {
    // Function to show Update button and hide Submit button
    function showUpdateButton() {
        const adminUpdateBtn = document.getElementById('adminUpdateBtn');
        const adminSubmitBtn = document.getElementById('adminSubmitBtn');
        const adminCancelBtn = document.getElementById('adminCancelBtn');

        if (adminUpdateBtn) {
            adminUpdateBtn.style.display = 'inline-block';  // Show the update button
            adminUpdateBtn.disabled = false;  // Enable the update button
        }
        if (adminSubmitBtn) {
            adminSubmitBtn.style.display = 'none';  // Hide the submit button
        }
        if (adminCancelBtn) {
            adminCancelBtn.style.display = 'inline-block'; // Show the cancel button
        }
    }

    // Function to enable and reset forms
    function unlockAndResetForms() {
        const adminsForm = document.getElementById('adminsForm');
        const admin_accountForm = document.getElementById('admin_accountForm');

        if (adminsForm) {
            adminsForm.reset();
            document.querySelectorAll('#adminsForm input, #adminsForm select').forEach(el => el.disabled = false);
        }

        if (admin_accountForm) {
            admin_accountForm.reset();
            document.querySelectorAll('#admin_accountForm input').forEach(el => el.disabled = false);
            document.querySelectorAll('#admin_accountForm select').forEach(el => el.disabled = false); // Unlock select fields
        }

        const adminSubmitBtn = document.getElementById('adminSubmitBtn');
        const adminCancelBtn = document.getElementById('adminCancelBtn');
        
        if (adminSubmitBtn) {
            adminSubmitBtn.disabled = false;
            adminSubmitBtn.style.display = 'inline-block'; // Show submit button
            console.log("adminSubmitBtn displayed"); // Debugging log
        }

        if (adminCancelBtn) {
            adminCancelBtn.style.display = 'inline-block';
            console.log("adminCancelBtn displayed"); // Debugging log
        }
    }

    // Disable and reset forms function
    function disableAndResetForms() {
        const adminsForm = document.getElementById('adminsForm');
        const admin_accountForm = document.getElementById('admin_accountForm');
    
        if (adminsForm) {
            adminsForm.reset();
            document.querySelectorAll('#adminsForm input, #adminsForm select').forEach(el => el.disabled = true);
        }
    
        if (admin_accountForm) {
            admin_accountForm.reset();
            document.querySelectorAll('#admin_accountForm input').forEach(el => el.disabled = true);
            document.querySelectorAll('#admin_accountForm select').forEach(el => el.disabled = true); // Lock select fields
        }
    
        const adminSubmitBtn = document.getElementById('adminSubmitBtn');
        const adminCancelBtn = document.getElementById('adminCancelBtn');
    
        if (adminSubmitBtn) {
            adminSubmitBtn.disabled = true; // Only disable, do not hide
        }
    
        if (adminCancelBtn) {
            adminCancelBtn.style.display = 'none'; // Hide cancel button
            console.log("adminCancelBtn hidden"); // Debugging log
        }
    }    

    document.getElementById('addAdminsBtn').addEventListener('click', function() {
        unlockAndResetForms();
        
        const adminUpdateBtn = document.getElementById('adminUpdateBtn');
        const adminSubmitBtn = document.getElementById('adminSubmitBtn');
        const adminDeleteBtn = document.getElementById('adminDeleteBtn'); // Ensure this button exists

        if (adminUpdateBtn) {
            adminUpdateBtn.style.display = 'none';  // Hide the update button
            console.log("adminUpdateBtn hidden"); // Debugging log
        }
        if (adminSubmitBtn) {
            adminSubmitBtn.style.display = 'inline-block';  // Show the submit button
            console.log("adminSubmitBtn displayed"); // Debugging log
        }
        if (adminDeleteBtn) {
            adminDeleteBtn.style.display = 'none';  // Hide the delete button
            console.log("adminDeleteBtn hidden"); // Debugging log
        }
    });

    document.getElementById('adminCancelBtn').addEventListener('click', function() {
        disableAndResetForms();  // Lock forms when "Cancel" is clicked
        this.style.display = 'none'; // Hide the cancel button
        console.log("adminCancelBtn hidden"); // Debugging log

        const adminUpdateBtn = document.getElementById('adminUpdateBtn');
        if (adminUpdateBtn) {
            adminUpdateBtn.style.display = 'none'; // Hide the update button
            console.log("adminUpdateBtn hidden from cancel"); // Debugging log
        }

        const adminDeleteBtn = document.getElementById('adminDeleteBtn');
        if (adminDeleteBtn) {
            adminDeleteBtn.style.display = 'none'; // Ensure this button is hidden
            console.log("adminDeleteBtn hidden from cancel"); // Debugging log
        }

        // Show adminSubmitBtn as inline-block
        const adminSubmitBtn = document.getElementById('adminSubmitBtn');
        if (adminSubmitBtn) {
            adminSubmitBtn.style.display = 'inline-block'; // Make submit button visible
            console.log("adminSubmitBtn displayed from cancel"); // Debugging log
        }
    });

    // Event listener for the intern buttons
    document.querySelectorAll('.intern-btn').forEach(button => {
        button.addEventListener('click', function() {
            const adminId = this.getAttribute('data-id'); // Get the admin ID
            loadAdminDetails(adminId); // Load the admin details
        });
    });
}