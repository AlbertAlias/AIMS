function showSection(event, sectionID) {
    // Remove 'active' class from all links (both sidebar and header)
    document.querySelectorAll('.sidebar-link, .menu-link').forEach(link => {
        link.classList.remove('active');
    });

    // Mark clicked link as active
    if (event && event.target) {
        const clickedLink = event.target.closest('.sidebar-link, .menu-link');
        if (clickedLink) {
            clickedLink.classList.add('active');
        }
    }

    // Hide all sections
    document.querySelectorAll('#dashboard, #departments, #coordinators, #interns, #sub-admins, #profile').forEach(section => {
        section.style.display = 'none';
    });

    // Show the active section
    const activeSection = document.getElementById(sectionID);
    if (activeSection) {
        activeSection.style.display = 'block';
    }
}

window.onload = function() {
    // Set the dashboard as the default active section and link
    showSection(null, 'dashboard'); 

    // Mark the dashboard link as active on load
    document.querySelector('a[href="#"][onclick*="dashboard"]').classList.add('active');
};