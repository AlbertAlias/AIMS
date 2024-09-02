document.querySelectorAll('input[name="userRole"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.getElementById('studentForm').style.display = 'none';
        document.getElementById('coordinatorForm').style.display = 'none';
        document.getElementById('supervisorForm').style.display = 'none';
        document.getElementById('registrarForm').style.display = 'none';

        const selectedRole = document.querySelector('input[name="userRole"]:checked').value;

        if (selectedRole === 'OJT Student') {
            document.getElementById('studentForm').style.display = 'block';
        } else if (selectedRole === 'OJT Coordinator') {
            document.getElementById('coordinatorForm').style.display = 'block';
        } else if (selectedRole === 'OJT Supervisor') {
            document.getElementById('supervisorForm').style.display = 'block';
        } else if (selectedRole === 'Registrar') {
            document.getElementById('registrarForm').style.display = 'block';
        }
    });
});