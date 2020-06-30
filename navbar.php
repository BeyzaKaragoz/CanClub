<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">


        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-home fa-fw"></i>
                    Home Page
                </a>
            </li>
        </ul>

        <?php if ($_SESSION["login_user"]["type"] == "0") { ?>
            <div class="dropdown-divider"></div>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>ADMIN MENU</span>
                <a class="d-flex align-items-center text-muted">
                    <i class="fas fa-plus-circle fa-fw"></i>
                </a>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link" href="add_activity.php">
                        <i class="fas fa-plus-circle fa-fw"></i>
                        Add Activity
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="types.php">
                        <i class="fas fa-plus-circle fa-fw"></i>
                        Activity Types
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_type.php">
                        <i class="fas fa-plus-circle fa-fw"></i>
                        Activity Type Add
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="departments.php">
                        <i class="fas fa-plus-circle fa-fw"></i>
                        Departments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_department.php">
                        <i class="fas fa-plus-circle fa-fw"></i>
                        Department Add
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">
                        <i class="fas fa-plus-circle fa-fw"></i>
                        Users List
                    </a>
                </li>
            </ul>
        <?php } ?>

        <div class="dropdown-divider"></div>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>ACCOUNT MENU</span>
            <a class="d-flex align-items-center text-muted">
                <i class="fas fa-plus-circle fa-fw"></i>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link">
                    <i class="fas fa-user fa-fw"></i>
                    <?php echo login_user_greeter(); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user_edit.php">
                    <i class="fas fa-pen fa-fw"></i>
                    Edit Account
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="process.php?process=logout">
                    <i class="fas fa-sign-out-alt fa-fw"></i>
                    Sign Out
                </a>
            </li>
        </ul>

    </div>
</nav>