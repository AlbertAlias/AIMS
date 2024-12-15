<div class="sidebar-container d-none d-md-flex flex-column p-0 m-0">
    <!-- Header -->
    <div class="sidebar-header d-flex flex-column align-items-center">
        <img src="../assets/img/esyatek-logo.png" alt="Logo" width="70">
    </div>

    <nav>
        <a href="#" class="sidebar-link" onclick="showSection(event, 'dashboard')">
            <i class="fa-solid fa-qrcode"></i>
            <span>Dashboard</span>
        </a>
        <a href="#" class="sidebar-link" onclick="showSection(event, 'requirements')">
            <i class="fa-solid fa-user-group"></i>
            <span>Requirements</span>
        </a>
        <a href="#" class="sidebar-link" onclick="showSection(event, 'weeklyreport')">
            <i class="fa-solid fa-graduation-cap"></i>
            <span>view</span>
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
        document.querySelectorAll('#dashboard, #requirements, #weeklyreport, #profile').forEach(section => {
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