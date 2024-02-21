<div class="oobe-wrapper">
    <img src="public/assets/oobe.svg">

            <div class="text-wrapper">

                <div class="title-large-text">
                    welcome <span class="accent">

                    <?php
                    echo $_SESSION['username'];
                    ?>                    </span>

                    !
                    <hr>

                </div>
                <?php
                function displayContent() {
                    if(isset($_SESSION["access_code"])) {
                        echo '<h1 class="title-large-text">' . $_SESSION["access_code"] . '</h1>';
                        echo '<div class="caption-text">';
                        echo 'Thank you for registering. Please save the one-time reset code above';
                        echo '</div>';
                        echo '<button class="btn" onclick="printAndSave()">Print</button>';
                        echo '<a class="btn" href="index.php?action=signin">Log In</a>';
                    }
                }

                include_once "template/features.php";?>
            </div>



<script>
    function printAndSave() {
        // Open the print dialog
        window.print();
    }
</script>