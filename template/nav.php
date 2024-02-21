<?php
use Frontend\InputButton\InputButton;
use Frontend\InputButton\InputButtonBuilder;

$name = "search_query";
$action='';
$label = "Search";
$svgFilename = "search.svg";
$isLabeled=false;
$attributes = ['class' => 'custom-class', 'data-custom' => 'value','required'];
?>

<section class="header-section">
    <div class="container">
        <?php if(isset($_SESSION['username'])): ?>

            <div class="nexus-header-item">
            <?php
            echo (new InputButtonBuilder())
                ->setLabel($label)
                ->setName($name)
                ->setSvgFilename($svgFilename)
                ->setAttributes($attributes)
                ->setIsLabeled($isLabeled)->build();
            ?>
        </div>
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
            <svg width="45" height="45" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M55 27.5C55 42.6878 42.6878 55 27.5 55C12.3122 55 0 42.6878 0 27.5C0 12.3122 12.3122 0 27.5 0C42.6878 0 55 12.3122 55 27.5Z" fill="#D9D9D9"/>
                <path d="M28.4834 38.4125H23.2735L14.5599 25.2359L14.5599 38.4125H9.35V17.05H14.5599L23.2735 30.2874V17.05L28.4834 17.05V38.4125Z" fill="#E1AF00"/>
                <path d="M28.4834 38.4125H23.2735L14.5599 25.2359L14.5599 38.4125H9.35V17.05H14.5599L23.2735 30.2874V17.05L28.4834 17.05V38.4125Z" fill="#24292F"/>
                <path d="M40.137 38.4125L35.7802 31.8698L31.9414 38.4125H26.0308L32.8859 27.5487L25.8784 17.05H31.9414L36.2373 23.5013L40.0152 17.05H45.9258L39.1316 27.8225L46.2 38.4125H40.137Z" fill="#E1AF00"/>
            </svg>

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
