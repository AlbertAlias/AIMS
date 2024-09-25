<ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #198754;" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <img src="../img/esyatek-logo.png" alt="Logo" width="70">
        </div>
        <div class="sidebar-brand-text mx-1">AIMS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item align-items-center justify-content-center" style="margin-top: 5px;">
        <a class="nav-link menu-link" href="#" onclick="showSection(event, 'dashboard');">
            <i class="fa-solid fa-qrcode fs-4"></i>
            <span class="">Dashboard</span>
        </a>
    </li>

    <li class="nav-item align-items-center justify-content-center" style="margin-top: 5px;">
        <a class="nav-link menu-link" href="#" onclick="showSection(event, 'departments');">
            <i class="fa-solid fa-scroll fs-4"></i>
            <span class="">Departments</span>
        </a>
    </li>

    <li class="nav-item align-items-center justify-content-center" style="margin-top: 5px;">
        <a class="nav-link menu-link" href="#" onclick="showSection(event, 'coordinators');">
            <i class="fa-solid fa-users fs-4"></i>
            <span>Coordinators</span>
        </a>
    </li>

    <li class="nav-item align-items-center justify-content-center" style="margin-top: 5px;">
        <a class="nav-link menu-link" href="#" onclick="showSection(event, 'interns');">
            <i class="fa-solid fa-user-graduate fs-4"></i>
            <span class="">Interns</span>
        </a>
    </li>

    <li class="nav-item align-items-center justify-content-center" style="margin-top: 5px;">
        <a class="nav-link menu-link" href="#" onclick="showSection(event, 'sub-admins');">
            <i class="fa-solid fa-user-shield fs-4"></i>
            <span class="">Admins</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
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
    const scriptsMap = {
        dashboard: [
            'crud-ajax/dashboard/retrieve-deptCounts.js',
            'crud-ajax/dashboard/retrieve-coorCounts.js',
            'crud-ajax/dashboard/retrieve-internCounts.js',
            'crud-ajax/dashboard/retrieve-adminCounts.js'
        ],
        departments: [
            'functions/departments/form-enable.js',
            'crud-ajax/departments/create-depts.js',
            'crud-ajax/departments/retrieve-depts.js',
            'crud-ajax/departments/update-depts.js',
            'crud-ajax/departments/delete-depts.js'
        ],
        coordinators: [
            'functions/coordinators/form-enable.js',
            'functions/coordinators/coor-email.js',
            'functions/coordinators/contact-number.js',
            'crud-ajax/coordinators/create-coor.js',
            'crud-ajax/coordinators/retrieve-coor.js',
            'crud-ajax/coordinators/retrieve-deptsName.js',
            'crud-ajax/coordinators/update-coor.js'
        ],
        interns: [
            'functions/interns/form-enable.js',
            'functions/interns/intern-email.js',
            'functions/interns/studID.js',
            'functions/interns/internPass.js',
            'crud-ajax/interns/create-interns.js',
            'crud-ajax/interns/retrieve-deptsName.js',
            'crud-ajax/interns/retrieve-interns.js',
            'crud-ajax/interns/update-interns.js'
        ],
        subAdmins: [
            'functions/admins/form-enable.js',
            'functions/admins/intern-email.js',
            'crud-ajax/admins/create-admins.js',
            'crud-ajax/admins/retrieve-admins.js',
            'crud-ajax/admins/update-admins.js'
        ]
        // adminProfile: [
        //     'functions/admin-profile/drag_drop.js',
        //     'crud-ajax/admin-profile/create_profile.js'
        // ]
    };

    function loadScripts(scripts) {
        // Remove previously loaded scripts
        const existingScripts = document.querySelectorAll('script[data-dynamic="true"]');
        existingScripts.forEach(script => script.remove());

        // Dynamically load the required scripts for the selected section
        scripts.forEach(function(src) {
            const script = document.createElement('script');
            script.src = src;
            script.defer = true;
            script.setAttribute('data-dynamic', 'true');
            document.body.appendChild(script);
        });
    }

    function showSection(event, sectionID) {
    // If there's no event target (i.e., on page load), skip the closest logic
    if (event && event.target) {
        const clickedLink = event.target.closest('.menu-link');
        if (clickedLink) {
            // Update the active link
            var menuLinks = document.querySelectorAll('.menu-link');
            menuLinks.forEach(function(link) {
                link.classList.remove('active');
            });
            clickedLink.classList.add('active');
        }
    }

    // Hide all sections
    var sections = document.querySelectorAll('#dashboard, #departments, #coordinators, #interns, #sub-admins');
    sections.forEach(function(section) {
        section.style.display = 'none';
    });

    // Show the selected section
    var activeSection = document.getElementById(sectionID);
    if (activeSection) {
        activeSection.style.display = 'block';
        loadScripts(scriptsMap[sectionID] || []); // Load the scripts for the active section
    }
}

// Set default section on page load
window.onload = function() {
    showSection(null, 'dashboard'); // Default section
};
</script>

