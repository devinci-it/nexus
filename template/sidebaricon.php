<?php
use Frontend\Sidebar\Sidebar;
use Frontend\Sidebar\IconSideBar;

    $sidebar = new IconSideBar();
?>


    <div class="logo-wrapper">
        <svg width="48" height="28" viewBox="0 0 48 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M24.9227 27.7647H18.1364L6.78627 10.6392L6.78627 27.7647H0V0H6.78627L18.1364 17.2046V1.24701e-06L24.9227 0V27.7647Z" fill="#E1AF00"/>
            <path d="M24.9227 27.7647H18.1364L6.78627 10.6392L6.78627 27.7647H0V0H6.78627L18.1364 17.2046V1.24701e-06L24.9227 0V27.7647Z" fill="#24292F"/>
            <path d="M40.1025 27.7647L34.4274 19.2613L29.427 27.7647H21.728L30.6573 13.645L21.5296 5.76741e-07H29.427L35.0227 8.38479L39.9438 5.76741e-07H47.6428L38.7929 14.001L48 27.7647H40.1025Z" fill="#E1AF00"/>
        </svg>

    <?php
    $sidebar->render("Upload");
    ?>
