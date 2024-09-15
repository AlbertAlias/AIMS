// Function to enable both coordinator and account information forms
function unlockForms() {
    // Enable form elements in coordinatorForm
    document.querySelectorAll('#coordinatorForm input, #coordinatorForm select').forEach(el => el.disabled = false);
    document.querySelectorAll('#accountInfoForm input').forEach(el => el.disabled = false);

    // Example condition to unlock other forms or fields
    if (document.querySelector('#someCheckbox') && document.querySelector('#someCheckbox').checked) {
        // Enable fields in another form or section
        document.querySelectorAll('#someOtherForm input, #someOtherForm select').forEach(el => el.disabled = false);
    }

    // Ensure buttons exist before modifying their styles
    const deleteBtn = document.getElementById('deleteBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const submitBtn = document.getElementById('submitBtn');
    
    // Unlock buttons if they exist
    if (deleteBtn) deleteBtn.style.display = 'inline-block';
    if (cancelBtn) cancelBtn.style.display = 'inline-block';
    if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.style.display = 'inline-block';
    }

    // Example of additional logic for handling specific sections
    if (document.getElementById('someCheckbox') && document.getElementById('someCheckbox').checked) {
        document.querySelectorAll('#someSection input').forEach(el => el.disabled = false);
    }
}


// Function to disable form elements and buttons
function disableFormElements() {
    document.querySelectorAll('#coordinatorForm input, #coordinatorForm select').forEach(el => el.disabled = true);
    document.querySelectorAll('#accountInfoForm input').forEach(el => el.disabled = true);

    // Ensure buttons exist before modifying their styles
    const deleteBtn = document.getElementById('deleteBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const submitBtn = document.getElementById('submitBtn');
    
    if (deleteBtn) deleteBtn.style.display = 'none';
    if (cancelBtn) cancelBtn.style.display = 'none';
    if (submitBtn) submitBtn.disabled = true;
    if (submitBtn) submitBtn.style.display = 'inline-block'; // Keep submit visible but disabled
}

// Event listener for unlocking forms when "Add Coordinator" is clicked
document.getElementById('addCoordinatorsBtn').addEventListener('click', function() {
    unlockForms();
});

// Event listener for unlocking forms when any coordinator button is clicked
document.getElementById('coordinatorInfo').addEventListener('click', function(event) {
    // Check if the clicked element is a coordinator button
    if (event.target && event.target.matches('button[data-id]')) {
        // Unlock forms when a coordinator is selected
        unlockForms();

        // Optional: Populate form with selected coordinator's data if needed
        const coordinatorId = event.target.getAttribute('data-id');
        console.log('Selected Coordinator ID:', coordinatorId);
        // You can add an AJAX request here to fetch and populate the coordinator's info
    }
});

// Event listener for the "Cancel" button
document.getElementById('cancelBtn').addEventListener('click', function() {
    disableFormElements(); // Lock forms when "Cancel" is clicked
});

// Expose functions to the global scope
window.enableFormElements = enableFormElements;
window.disableFormElements = disableFormElements;
window.resetFormElements = resetFormElements;