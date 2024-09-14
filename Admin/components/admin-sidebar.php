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
    <li class="nav-item align-items-center justify-content-center <?php echo $current_page === 'pages/admin-dashboard.php' ? 'active' : ''; ?>" style="margin-top: 5px;">
        <a class="nav-link" href="javascript:void(0);" onclick="loadPage('pages/admin-dashboard.php')">
            <i class="fa-solid fa-qrcode"></i>
            <span class="">Dashboard</span>
        </a>
    </li>

    <li class="nav-item align-items-center justify-content-center <?php echo $current_page === 'pages/add-users.php' ? 'active' : ''; ?>" style="margin-top: 5px;">
        <a class="nav-link" href="javascript:void(0);" onclick="loadPage('pages/add-users.php')">
            <i class="fa-solid fa-user-plus"></i>
            <span class="">Add Users</span>
        </a>
    </li>

    <li class="nav-item align-items-center justify-content-center <?php echo $current_page === 'pages/manage-users.php' ? 'active' : ''; ?>" style="margin-top: 5px;">
        <a class="nav-link" href="javascript:void(0);" onclick="loadPage('pages/manage-users.php')">
            <i class="fa-solid fa-users-gear"></i>
            <span class="">Manage Users</span>
        </a>
    </li>

    <li class="nav-item align-items-center justify-content-center <?php echo $current_page === 'pages/departments.php' ? 'active' : ''; ?>" style="margin-top: 5px;">
        <a class="nav-link" href="javascript:void(0);" onclick="loadPage('pages/departments.php')">
            <i class="fa-solid fa-scroll"></i>
            <span class="">Departments</span>
        </a>
    </li>

    <li class="nav-item align-items-center justify-content-center <?php echo $current_page === 'pages/coordinators.php' ? 'active' : ''; ?>" style="margin-top: 5px;">
        <a class="nav-link" href="javascript:void(0);" onclick="loadPage('pages/coordinators.php')">
            <i class="fa-solid fa-address-card"></i>
            <span class="">Coordinators</span>
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