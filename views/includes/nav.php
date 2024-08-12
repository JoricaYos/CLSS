<nav id="sidebar">
    <div class="custom-menu">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
        </button>
    </div>
    <div class="p-4 pt-5">
       <div class="mb-5 text-center justify-content-center">
                <div>
                    <img src="/assets/smcc-logo.png" alt="SMCC-LOGO" width="50px" height="50px">
                    <h1 class="h6">SAINT MICHAEL COLLEGE OF CARAGA</h1>
                </div>
            </div>

        <ul class="list-unstyled components mb-5">
            <?php if ($_SESSION['role'] != 'student'): ?>
                <li>
                    <a href="/views/dashboard/dashboard.php"><i class="fas fa-chart-bar"></i> DASHBOARD</a>
                </li>
            <?php endif; ?>
            <li>
                <a href="/views/profile/profile.php"><i class="fa fa-user"></i> PROFILE</a>
            </li>
            <?php if ($_SESSION['role'] == 'Admin'): ?>
                <li>
                    <a href="/views/accounts/accounts.php"><i class="fa fa-user"></i> USER ACCOUNTS</a>
                </li>
            <?php endif; ?>
            <li>
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fa fa-calendar-check"></i> SCHEDULES
                </a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li><a href="/views/laboratories/lab1.php">Computer lab 1</a></li>
                    <li><a href="/views/laboratories/lab2.php">Computer lab 2</a></li>
                    <li><a href="/views/laboratories/lab3.php">Computer lab 3</a></li>
                    <li><a href="/views/laboratories/lab4.php">Computer lab 4</a></li>
                </ul>
            </li>
            <?php if ($_SESSION['role'] == 'Admin'): ?>
                <li>
                    <a href="/views/settings/settings.php"><i class="fas fa-cogs"></i></i> SETTINGS</a>
                </li>
            <?php endif; ?>
        </ul>
        <div class="mb-5 text-center justify-content-center">
            <div>
                <h2 class="h6">Computer Laboratory Scheduling System</h2>
                <p>VERSION 1.0</p>
            </div>
        </div>
    </div>
</nav>