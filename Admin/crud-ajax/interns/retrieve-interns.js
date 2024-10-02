$(document).ready(function() {
    window.loadInterns = function() {
        $.ajax({
            url: 'controller/interns/retrieve-interns.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                let internsInfo = $('#internsInfo');
                internsInfo.empty();
                if (response.error) {
                    internsInfo.append(`<p>${response.error}</p>`);
                } else {
                    response.forEach(function(intern) {
                        let btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 intern-btn" data-id="${intern.id}">
                                        ${intern.last_name}, ${intern.first_name}
                                    </button>`;
                        internsInfo.append(btn);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to load interns:', error);
            }
        });
    };

    loadInterns();
});