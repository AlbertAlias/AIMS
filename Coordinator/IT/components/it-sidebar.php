<div class="sidebar-container d-none d-md-flex flex-column p-0 m-0">
    <!-- Header -->
    <div class="sidebar-header d-flex flex-column align-items-center">
        <img src="../../img/esyatek-it-logo.png" alt="Logo" width="45">
    </div>

    <nav>
        <a href="#" class="sidebar-link" onclick="showSection(event, 'dashboard')">
            <i class="fa-solid fa-qrcode"></i>
            <span>Dashboard</span>
        </a>
        <a href="#" class="sidebar-link" onclick="showSection(event, 'internlist')">
            <i class="fa-solid fa-graduation-cap"></i>
            <span>Interns Lists</span>
        </a>
        <a href="#" class="sidebar-link" onclick="showSection(event, 'reports')">
            <i class="fa-solid fa-file-signature"></i>
            <span>Reports</span>
        </a>
    </nav>
</div>

<script>
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
        document.querySelectorAll('#dashboard, #internlist, #reports, #profile, #post-requirements, #evaluate ').forEach(section => {
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
</script>