<nav class="navbar navbar-expand navbar-light bg-white topbar m-0 p-0 px-2 sticky-top" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
    <!-- Add icon button on the left side -->
    <div class="d-flex align-items-center">
        <button id="sidebar-toggle" class="btn btn-link me-3">
            <i class="fa-solid fa-bars fs-4" style="color: #198754;"></i>
        </button>
    </div>

    <div id="welcomeAdmin" class="text-dark ml-3">
        <!-- This will be updated by JS -->
    </div>

    <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="d-flex align-items-center">
                    <div id="profile-container" class="img-profile rounded-circle">
                        <i class="fa-solid fa-user" id="default-header-icon" style="color: gray;"></i>
                    </div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item d-flex align-items-center menu-link" href="#" onclick="showSection(event, 'profile');">
                    <i class="fa-solid fa-user fa-lg fa-fw me-2" style="color: #017e3e;"></i>Profile
                </a>
                <a class="dropdown-item d-flex align-items-center" href="../index.php">
                    <i class="fa-solid fa-right-from-bracket fa-lg fa-fw me-2" style="color: #017e3e;"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>