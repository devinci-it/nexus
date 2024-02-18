<section class="header-section">
    <div class="container">
        <div class="nexus-header-item">

        </div>
        <?php if(isset($_SESSION['username'])): ?>
            <div class="nav-wrapper">
                <div class="nexus-header-item nexus-header-item-mr-0">
                    <a href="?page=dashboard" class="nexus-header-link" >
                        <img class="nexus-avatar" src="<?php echo ICONS_PATH; ?>user_icon.svg" alt="User Avatar" height="20" width="20" />
                        <p class="caption-text dark"><?php echo $_SESSION['username']; ?></p>
                    </a>
                </div>
                <div class="nexus-header-item nexus-header-item-mr-0">
                    <a href="upload.php" class="nexus-header-link">
                        <p class="caption-text dark">Libraries</p>
                    </a>
                </div>
                <div class="nexus-header-item nexus-header-item-mr-0">
                    <a href="logout.php" class="nexus-header-link">
                        <p class="caption-text dark">Logout</p>
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="nav-wrapper">
                <div class="nexus-header-item nexus-header-item-mr-0">
                    <a href="?page=login" class="nexus-header-link">
                        <p class="caption-text dark">Login</p>
                    </a>
                </div>
                <div class="nexus-header-item nexus-header-item-mr-0">
                    <a href="?page=signup" class="nexus-header-link">
                        <p class="caption-text dark">Signup</p>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
