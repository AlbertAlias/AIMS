// delete-depts.js
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.deleteDeptBtn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const deptId = this.getAttribute('data-id');

            fetch('delete-depts.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: deptId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Department deleted successfully.');
                    // Optionally, you can refresh the list of departments
                } else {
                    alert('Error deleting department: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
