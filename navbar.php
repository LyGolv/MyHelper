<?php
$url = $_SERVER['PHP_SELF'];
$reg = '#^(.+[\\\/])*([^\\\/]+)$#';
define('pageencours', preg_replace($reg, '$2', $url));
$_SESSION['pageprecedente'] = pageencours;?>
<nav id="navbar">
    <div class="left-part">
        <button id="menu-btn" >
            <span class="material-icons-sharp">menu</span>
        </button>
        <div class="top visible">
            <div class="logo">
                <img src="images/MyHelper-white.svg" alt="Logo">
            </div>
        </div>
    </div>
    <div class="right-part">
        <div class="theme-toggler">
            <span class="material-icons-sharp">light_mode</span>
            <span class="material-icons-sharp active">dark_mode</span>
        </div>
        <div class="profile">
            <div class="info">
                <p>Hey, <b class="username"><?php echo $_SESSION['user_name'] ?></b></p>
                <small class="text-muted">User</small>
            </div>
            <div class="profile-photo dropdown-toggle">
                <img src="<?php echo $_SESSION['user_image']; ?>" alt="profile">
            </div>
        </div>
    </div>
</nav>

<div class="profile-dropdown">
    <h1>Welcome <b class="username">Daniel</b></h1>
    <div class="profile-dropdown-top">
        <ul>
            <li>
                <a href="user.php">
                    <span class="material-icons-sharp">person_outline</span>
                    <h3>Profile</h3>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="material-icons-sharp">settings</span>
                    <h3>Setting</h3>
                </a>
            </li>
        </ul>
    </div>
    <div class="profile-dropdown-bottom">
        <ul>
            <li>
                <a href="logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </li>
        </ul>
    </div>
</div>