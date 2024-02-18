<form action="includes/RegistrationHandler.php" method="post" onsubmit="return validateForm()">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" id="password" name="password" required><br>
    Verify Password: <input type="password" id="verify_password" name="verify_password" required><br>
    First Name: <input type="text" name="firstname" required><br>
    Last Name: <input type="text" name="lastname" required><br>
    Email: <input type="email" name="email" required><br>

    <input type="submit" value="Register">
</form>

<script>
    function validateForm() {
        const password = document.getElementById("password").value;
        const verifyPassword = document.getElementById("verify_password").value;

        if (password != verifyPassword) {
            alert("Passwords do not match");
            return false;
        }
        return true;
    }
</script>
