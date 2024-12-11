$(document).ready(function() {
    // Load students for the coordinator's department
    window.loadStudents = function() {
        $.ajax({
            url: 'controller/retrieve-coor.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Update the datatable with the students' data
                    updateStudentTable(response.students);
                } else {
                    console.error('Failed to load students:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to load students:', error);
            }
        });
    };

    // Function to dynamically populate the student table
    function updateStudentTable(students) {
        let studentTableBody = $('#studentTableBody');
        studentTableBody.empty();

        if (students.length === 0) {
            studentTableBody.append('<tr><td colspan="2" class="text-center">No students found</td></tr>');
            return;
        }


        students.forEach(function(student) {
            let row = `
                <button class="btn btn-outline-secondary d-block mb-2 w-100 coor-btn">
                    ${student.first_name} ${student.last_name}
                </button>`;
            coordinatorInfo.innerHTML += row;
        });
        
    }

    // Trigger the student data load on page load
    loadStudents();
});
