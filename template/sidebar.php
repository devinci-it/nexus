
<?php

/**
 * Include the Sidebar class and render a sidebar.
 *
 * If the Sidebar class is not defined, include the autoload file.
 * Then, create an instance of the Sidebar class and render the sidebar.
 */


if (!class_exists('Frontend\\Sidebar\\Sidebar')) {
    require_once __DIR__ . "/../vendor/autoload.php";
}
$homePath=$_SESSION['home_path'];
$pngFilePath = $homePath . "/user_icon.png";
$photo = file_exists($pngFilePath) ? $pngFilePath : $homePath . "/user_icon.svg";

?>
<aside class="side-nav">
    <div class="logo-wrapper">
        <svg width="48" height="28" viewBox="0 0 48 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M24.9227 27.7647H18.1364L6.78627 10.6392L6.78627 27.7647H0V0H6.78627L18.1364 17.2046V1.24701e-06L24.9227 0V27.7647Z" fill="#E1AF00"/>
            <path d="M24.9227 27.7647H18.1364L6.78627 10.6392L6.78627 27.7647H0V0H6.78627L18.1364 17.2046V1.24701e-06L24.9227 0V27.7647Z" fill="#24292F"/>
            <path d="M40.1025 27.7647L34.4274 19.2613L29.427 27.7647H21.728L30.6573 13.645L21.5296 5.76741e-07H29.427L35.0227 8.38479L39.9438 5.76741e-07H47.6428L38.7929 14.001L48 27.7647H40.1025Z" fill="#E1AF00"/>
        </svg>

    </div>


    <?php

    $current_page=$_GET['page'];
        $sidebar = new Frontend\Sidebar\Sidebar();
        $sidebar->render($current_page);

    ?>
<div>
    <div class="id-wrapper">


        <img src="<?php echo $photo;?>" alt="User Icon" class="circular-icon" id="user_dp">


        <p class="body-medium-text">
            <?php echo $_SESSION['username'];?>
        </p>
        <p class="caption-text">
            USER ID:   <?php echo $_SESSION['user_id'];?>

        </p>

    </div>
    <p class="caption-text">© 2024 nexus | ™</p>



</div>


</aside>
