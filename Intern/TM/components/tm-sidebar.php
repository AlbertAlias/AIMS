<ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #198754;" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <img src="../../img/esyatek-tm-logo.png" alt="Logo" width="55">
        </div>
        <!-- <div class="sidebar-brand-text mx-1">AIMS</div> -->
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item align-items-center justify-content-center" style="margin-top: 5px;">
        <a class="nav-link menu-link" href="#" onclick="showSection(event, 'dashboard');">
            <i class="fa-solid fa-qrcode fs-4"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item align-items-center justify-content-center" style="margin-top: 5px;">
        <a class="nav-link menu-link" href="#" onclick="showSection(event, 'weekly-reports');">
            <i class="fa-solid fa-scroll fs-4"></i>
            <span>Reports</span>
        </a>
    </li>

    <li class="nav-item align-items-center justify-content-center" style="margin-top: 5px;">
        <a class="nav-link menu-link" href="#" onclick="showSection(event, 'requirements');">
            <i class="fa-solid fa-user-graduate fs-4"></i>
            <span>Requirement</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0 fs-5" id="sidebarToggle"></button>
    </div>
</ul>

    <!-- Nav Item - Manage Users -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseAddUser" aria-expanded="true" aria-controls="collapseAddUser">
            <i class="fa-solid fa-user-gear"></i>
            <span class="text-black">Manage Users</span>
            <i class="fas fa-chevron-right rotate-icon" style="margin-top: 6px; float: right; transition: transform 0.2s ease-in-out;"></i>
        </a>
        <div class="collapse" id="collapseAddUser" aria-labelledby="headingAddUser" data-bs-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item">Add Users</a>
                <a class="collapse-item">View Users</a>
            </div>
        </div>
    </li> -->

    <script>
    function showSection(event, sectionID) {
    if (event && event.target) {
        const clickedLink = event.target.closest('.menu-link');
        if (clickedLink) {
            var menuLinks = document.querySelectorAll('.menu-link');
            menuLinks.forEach(function(link) {
                link.classList.remove('active');
            });
            clickedLink.classList.add('active');
        }
    }

    var sections = document.querySelectorAll('#dashboard, #weekly-reports, #requirements');
    sections.forEach(function(section) {
        section.style.display = 'none';
    });

    var activeSection = document.getElementById(sectionID);
    if (activeSection) {
        activeSection.style.display = 'block';
    }
}


    window.onload = function() {
        showSection(null, 'dashboard');
    };
</script>