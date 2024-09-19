document.addEventListener('DOMContentLoaded', function () {
    const updateBtn = document.getElementById('updateBtn');
    const coordinatorForm = document.getElementById('coordinatorForm');
    const accountInfoForm = document.getElementById('accountInfoForm');

    if (!updateBtn) {
        console.error('Update button not found.');
        return;
    }
    if (!coordinatorForm || !(coordinatorForm instanceof HTMLFormElement)) {
        console.error('Coordinator form is missing or not an HTMLFormElement.');
        return;
    }
    if (!accountInfoForm || !(accountInfoForm instanceof HTMLFormElement)) {
        console.error('Account info form is missing or not an HTMLFormElement.');
        return;
    }

    function updateCoordinator(event) {
        event.preventDefault();

        const coordinatorData = new FormData(coordinatorForm);
        const accountData = new FormData(accountInfoForm);

        const combinedData = new FormData();
        for (const [key, value] of coordinatorData.entries()) {
            combinedData.append(key, value);
        }
        for (const [key, value] of accountData.entries()) {
            combinedData.append(key, value);
        }

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

    updateBtn.addEventListener('click', updateCoordinator);
});