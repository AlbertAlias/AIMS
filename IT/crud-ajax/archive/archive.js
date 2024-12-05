document.getElementById('archiveButton').addEventListener('click', function() {
    // Confirm the archive action
    if (confirm('Are you sure you want to archive all student records?')) {
        // Send AJAX request to archive students
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'controller/archive/archive.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        alert(response.message);
                        // Optionally, reload the page or update the UI
                        location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                } else {
                    alert('There was an issue with the request.');
                }
            }
        };

        // Send an empty object to the server as the data (no need for student IDs as all students are archived)
        xhr.send(JSON.stringify({}));

    }
});
