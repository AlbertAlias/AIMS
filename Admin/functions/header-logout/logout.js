function logout() {
    $.ajax({
        url: 'controller/header-logout/logout.php',
        type: 'POST',
        success: function() {
            window.location.href = '../../index.php';
        }
    });
}