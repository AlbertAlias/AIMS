document.addEventListener("DOMContentLoaded", function() {
    const internsInfo = document.getElementById('internsInfo');
    const searchInput = document.getElementById('searchInterns');

    window.fetchInterns = function() {
        fetch('controller/interns/retrieve-interns.php')
            .then(response => response.json())
            .then(interns => {
                window.interns = interns; // Store interns in a variable for filtering
                updateInternList(window.interns);
            })
            .catch(error => {
                console.error('Failed to load interns:', error);
            });
    };

    function updateInternList(interns) {
        internsInfo.innerHTML = interns.map(intern => {
            let department = intern.department_name ? intern.department_name : 'No Department';
            return `<button class="btn btn-outline-secondary d-block mb-2 w-100 intern-btn" data-id="${intern.id}">
                        ${intern.last_name}, ${intern.first_name}<br>${department}
                    </button>`;
        }).join('');
    }

    // Search functionality
    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const filteredInterns = window.interns.filter(intern =>
            intern.last_name.toLowerCase().includes(query) || 
            intern.first_name.toLowerCase().includes(query) || 
            (intern.department_name && intern.department_name.toLowerCase().includes(query))
        );
        updateInternList(filteredInterns);
    });

    // Fetch interns on page load
    window.fetchInterns();
});