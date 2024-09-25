<ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #198754;" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <img src="../../img/esyatek-crim-logo.png" alt="Logo" width="60">
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
        <a class="nav-link menu-link" href="#" onclick="showSection(event, 'requirements');">
            <i class="fa-solid fa-scroll fs-4"></i>
            <span class="">Requirements</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

<script>
    // const scriptsMap = {
    //     dashboard: [
    //         'crud-ajax/dashboard/retrieve-deptCounts.js',
    //         'crud-ajax/dashboard/retrieve-coorCounts.js',
    //         'crud-ajax/dashboard/retrieve-internCounts.js',
    //         'crud-ajax/dashboard/retrieve-adminCounts.js'
    //     ],
    //     departments: [
    //         'functions/departments/form-enable.js',
    //         'crud-ajax/departments/create-depts.js',
    //         'crud-ajax/departments/retrieve-depts.js',
    //         'crud-ajax/departments/update-depts.js',
    //         'crud-ajax/departments/delete-depts.js'
    //     ]
    // };

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