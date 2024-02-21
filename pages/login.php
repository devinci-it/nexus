<?php
use Frontend\InputIcon\InputIcon;
use Frontend\InputIcon\InputIconBuilder;
?>

<style>
    footer.footer-section>.container{
        justify-items: center;
    }
</style>
<main class="main-content" id="login-content">
    <div class="container">
        <div class="container login-container">
            <h2 class="body-medium-text">USER LOGIN</h2>
            <form action="includes/LoginHandler.php" method="post">
                    <?php
                    // Generate the InputIcon for the username field
                   $userNameInput =  (new InputIconBuilder())
                        ->setName('usernameInput')
                        ->setSvgFilename('username.svg')
                        ->setIsLabeled(false)
                        ->setTypeName('text')
                        ->setIsError(false)
                        ->setStickyValue('')
                        ->setPlaceholder('Username')
//                        ->setAttributes(['class' => 'form-input', 'required' => 'required'])
                        ->build();

                    // Generate the HTML for the InputIcon
                    echo $userNameInput->generate();
                    ?>

                <br>
                    <?php
                    // Generate the InputIcon for the password field
                    $passwordIcon = (new InputIconBuilder())
                        ->setName('passwordInput')
                        ->setSvgFilename('password.svg')
                        ->setIsLabeled(false)
                        ->setTypeName('password')
                        ->setIsError(false)
                        ->setStickyValue('')
                        ->setPlaceholder('Password')
//                        ->setAttributes(['class' => 'form-input', 'required' => 'required'])
                        ->build();

                    // Generate the HTML for the InputIcon
                   echo $passwordIcon->generate();
                    ?>
                <input class="btn submit-button" type="submit" value="Login">
            </form>
        </div>
    </div>
</main>
