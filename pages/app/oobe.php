
<main>

    <div class="container"id="home">
            <!-- Display Photo -->
<!--            <div style="border-bottom: 1px solid #ccc; padding-bottom: 10px;">-->
<!--                <label for="displayPhoto" style="cursor: pointer;">-->
<!--                    <img id="displayPhotoPreview" src="../../public/assets/icons/default.svg" alt="Default Photo"-->
<!--                         style="max-width: 50px; max-height: 50px;">-->
<!--                </label>-->
<!--                <input type="file" id="displayPhoto" name="displayPhoto" accept="image/*"-->
<!--                       onchange="previewDisplayPhoto(this)" style="display: none;">-->
<!--                <h1 class="title-small-text">--><?php //echo $_SESSION["username"]; ?><!--</h1>-->
<!---->
<!--            </div>-->
<!---->
<!--            <p class="caption-text">User ID: --><?php //echo $_SESSION["user_id"]; ?><!--</p>-->
<!---->
<!--            <a class="btn" href="../../index.php?action=signin">Save</a>-->

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

</main>




<script>
    function printAndSave() {
        // Open the print dialog
        window.print();
    }
</script>