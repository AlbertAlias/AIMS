// Function to load and display coordinators
function loadCoordinators() {
    fetch('controller/add-coor/retrieve-coor.php')
        .then(response => response.json())
        .then(data => {
            if (Array.isArray(data)) {
                const coordinatorInfo = document.getElementById('coordinatorInfo');
                coordinatorInfo.innerHTML = data.map(coordinator => `
                    <button class="btn btn-outline-secondary d-block mb-2 w-100" data-id="${coordinator.id}">
                        ${coordinator.last_name}, ${coordinator.first_name}
                    </button>
                `).join('');

                // Add event listeners to each coordinator button
                coordinatorInfo.querySelectorAll('button').forEach(button => {
                    button.addEventListener('click', function() {
                        const coordinatorId = this.getAttribute('data-id');
                        fetchCoordinatorDetails(coordinatorId);
                    });
                });
            } else {
                document.getElementById('coordinatorInfo').innerHTML = '<p class="text-danger">No coordinators found.</p>';
            }
        })
        .catch(error => {
            document.getElementById('coordinatorInfo').innerHTML = `<p class="text-danger">Error loading coordinators: ${error.message}</p>`;
        });
}

// Function to fetch and display coordinator details
function fetchCoordinatorDetails(id) {
    fetch(`controller/add-coor/retrieve-coor.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            console.log(data); // Add this line to check the retrieved data
            if (data) {
                // Populate form with coordinator details
                document.getElementById('last-name').value = data.last_name || '';
                document.getElementById('first-name').value = data.first_name || '';
                document.getElementById('middle-name').value = data.middle_name || '';
                document.getElementById('suffix').value = data.suffix || '';
                document.getElementById('gender').value = data.gender || '';
                document.getElementById('address').value = data.address || '';
                document.getElementById('birthdate').value = data.birthdate || '';
                document.getElementById('civil-status').value = data.civil_status || '';
                document.getElementById('personal-email').value = data.personal_email || '';
                document.getElementById('contact-number').value = data.contact_number || '';
                document.getElementById('department').value = data.department || '';

                // Enable form fields
                document.querySelectorAll('#coordinatorForm input, #coordinatorForm select').forEach(el => el.disabled = false);

                // Show buttons
                document.getElementById('submitBtn').style.display = 'inline-block';
                document.getElementById('cancelBtn').style.display = 'inline-block';
                document.getElementById('deleteBtn').style.display = 'inline-block';
            } else {
                alert('Coordinator details not found.');
            }
        })
        .catch(error => {
            alert(`Error fetching coordinator details: ${error.message}`);
        });
}

// Function to handle form submission
document.getElementById('coordinatorForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
    fetch('controller/add-coor/create-coor.php', {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            alert('Coordinator details saved successfully.');
            loadCoordinators();
        } else {
            alert(`Error saving coordinator details: ${result.message}`);
        }
    })
    .catch(error => {
        alert(`Error saving coordinator details: ${error.message}`);
    });
});

// Cancel button event handler
document.getElementById('cancelBtn').addEventListener('click', function() {
    // Clear form fields and disable them
    document.querySelectorAll('#coordinatorForm input, #coordinatorForm select').forEach(el => {
        el.value = '';
        el.disabled = true;
    });

    // Hide buttons
    document.getElementById('submitBtn').style.display = 'none';
    document.getElementById('cancelBtn').style.display = 'none';
    document.getElementById('deleteBtn').style.display = 'none';
});

// Delete button event handler
document.getElementById('deleteBtn').addEventListener('click', function() {
    const id = document.getElementById('coordinatorId').value; // You need to handle how you get this ID
    
    fetch(`controller/add-coor/delete-coor.php?id=${id}`, {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            alert('Coordinator deleted successfully.');
            loadCoordinators();
        } else {
            alert(`Error deleting coordinator: ${result.message}`);
        }
    })
    .catch(error => {
        alert(`Error deleting coordinator: ${error.message}`);
    });
});

// Initial load of coordinators
document.addEventListener('DOMContentLoaded', loadCoordinators);