<nav class="navbar navbar-expand navbar-light bg-white topbar m-0 p-0 px-2 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <div id="welcomeAdmin" class="text-dark ml-3">
        <!-- This will be updated by JS -->
    </div>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="d-flex align-items-center">
                    <div id="profile-initials" class="img-profile rounded-circle" style="width: 40px; height: 40px; background-color: #ccc; color: white; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                         <!-- This will be updated by JS -->
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