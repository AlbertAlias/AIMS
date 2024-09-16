document.addEventListener('DOMContentLoaded', function () {
    const submitBtn = document.getElementById('submitBtn');
    const coordinatorForm = document.getElementById('coordinatorForm');
    const accountInfoForm = document.getElementById('accountInfoForm');
    const coordinatorId = document.getElementById('coordinator_id').value; // Get coordinator ID

    // Function to handle the submission of both forms via AJAX
    function submitForms(event) {
        event.preventDefault();

        // Check if this is an update (i.e., if the coordinator ID exists)
        if (coordinatorId) {
            // FormData for both forms
            const coordinatorData = new FormData(coordinatorForm);
            const accountData = new FormData(accountInfoForm);

            // Create an object to store combined data
            const combinedData = new FormData();

            // Append all data from both forms to the combinedData
            for (const [key, value] of coordinatorData.entries()) {
                combinedData.append(key, value);
            }
            for (const [key, value] of accountData.entries()) {
                combinedData.append(key, value);
            }

            // AJAX request to submit the data to update-coor.php
            fetch('controller/coordinators/update-coor.php', {
                method: 'POST',
                body: combinedData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Update successful!');
                    location.reload();
                } else {
                    alert('Update failed: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        } else {
            // This is a create operation, don't do anything in update-coor.js
            console.log('No coordinator ID found, skipping update.');
        }
    }

    // Attach event listener to the submit button
    submitBtn.addEventListener('click', submitForms);
});