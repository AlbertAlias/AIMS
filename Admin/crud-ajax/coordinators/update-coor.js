document.addEventListener('DOMContentLoaded', function () {
    const updateBtn = document.getElementById('updateBtn');
    const coordinatorForm = document.getElementById('coordinatorForm');
    const accountInfoForm = document.getElementById('accountInfoForm');

    // Function to handle the update operation via AJAX
    function updateCoordinator(event) {
        event.preventDefault();

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
    }

    // Attach event listener to the update button
    updateBtn.addEventListener('click', updateCoordinator);
});