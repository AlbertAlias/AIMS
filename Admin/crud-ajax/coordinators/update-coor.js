document.addEventListener('DOMContentLoaded', function () {
    const coorUpdateBtn = document.getElementById('coorUpdateBtn');
    const coordinatorForm = document.getElementById('coordinatorForm');
    const coor_accountForm = document.getElementById('coor_accountForm');

    if (!coorUpdateBtn) {
        console.error('Update button not found.');
        return;
    }
    if (!coordinatorForm || !(coordinatorForm instanceof HTMLFormElement)) {
        console.error('Coordinator form is missing or not an HTMLFormElement.');
        return;
    }
    if (!coor_accountForm || !(coor_accountForm instanceof HTMLFormElement)) {
        console.error('Account info form is missing or not an HTMLFormElement.');
        return;
    }

    function updateCoordinator(event) {
        event.preventDefault();

        const coordinatorData = new FormData(coordinatorForm);
        const accountData = new FormData(coor_accountForm);

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

    coorUpdateBtn.addEventListener('click', updateCoordinator);
});