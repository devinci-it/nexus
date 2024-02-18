<?php
$password="P@ssw0rd";
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

echo $hashedPassword;