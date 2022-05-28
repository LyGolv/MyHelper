<aside>
    <div class="top">
        <div class="logo">
            <img src="images/MyHelper-white.svg" alt="Logo">
            <h2></h2>
        </div>
        <div class="close" id="close-btn">
            <span class="material-icons-sharp">close</span>
        </div>
    </div>

    <div class="sidebar">
        <a href="home.php" class="<?php if ($_SESSION['pageprecedente'] == 'home.php') echo 'active' ?>">
            <span class="material-icons-sharp">grid_view</span>
            <h3>Dashboard</h3>
        </a>
        <a href="user.php" class="<?php if ($_SESSION['pageprecedente'] == 'user.php') echo 'active' ?>">
            <span class="material-icons-sharp">person_outline</span>
            <h3>User</h3>
        </a>
        <a href="#">
            <span class="material-icons-sharp">insights</span>
            <h3>Suivie</h3>
        </a>
        <a href="#" class="notif">
            <span class="material-icons-sharp">mail_outline</span>
            <h3>Messages</h3>
            <span class="message-count">26</span>
        </a>
        <a href="logout.php">
            <span class="material-icons-sharp">logout</span>
            <h3>Logout</h3>
        </a>
    </div>
</aside>