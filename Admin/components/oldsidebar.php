<ul class="navbar-nav sidebar sidebar-dark accordion d-flex flex-column align-items-center" id="accordionSidebar" style="background-color: #198754;">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <img src="../img/esyatek-logo-1.png" alt="Logo" width="55">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Items -->
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="#" onclick="showSection(event, 'dashboard');">
            <i class="fa-solid fa-qrcode"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="#" onclick="showSection(event, 'departments');">
            <i class="fa-solid fa-scroll"></i>
            <span>Departments</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="#" onclick="showSection(event, 'coordinators');">
            <i class="fa-solid fa-user-group"></i>
            <span>Coordinators</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="#" onclick="showSection(event, 'interns');">
            <i class="fa-solid fa-user-graduate"></i>
            <span>Interns</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="#" onclick="showSection(event, 'sub-admins');">
            <i class="fa-solid fa-user-gear"></i>
            <span>Admins</span>
        </a>
    </li>
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
                const clickedLink = event.target.closest('.nav-link'); // Changed from '.menu-link' to '.nav-link'
                if (clickedLink) {
                    var sidebarLinks = document.querySelectorAll('.nav-link');
                    sidebarLinks.forEach(function(link) {
                        link.classList.remove('active');
                    });
                    clickedLink.classList.add('active'); // Only add 'active' to clicked nav-link
                }
            }

            var sections = document.querySelectorAll('#dashboard, #departments, #coordinators, #interns, #sub-admins, #profile');
            sections.forEach(function(section) {
                section.style.display = 'none';
            });

            var activeSection = document.getElementById(sectionID);
            if (activeSection) {
                activeSection.style.display = 'block';
            }

            var activeNavItem = document.querySelector(`#accordionSidebar a[onclick*="${sectionID}"]`)?.parentElement;
            if (activeNavItem) {
                var sidebarItems = document.querySelectorAll('.nav-item');
                sidebarItems.forEach(function(item) {
                    item.classList.remove('active'); // Remove active from nav-item
                });
                activeNavItem.classList.add('active'); // Add active to the parent nav-item
            }
        }

        window.onload = function() {
            showSection(null, 'dashboard');

            var dashboardLink = document.querySelector(`#accordionSidebar a[onclick*="dashboard"]`).parentElement;
            if (dashboardLink) {
                dashboardLink.classList.add('active');
            }
        };
    </script>