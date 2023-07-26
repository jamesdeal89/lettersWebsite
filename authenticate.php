<?php

include 'User.php';

$env = parse_ini_file('.env');

$user = new User($env["DATABASENAME"], $env["URL"], $env["DATABASEUSR"], $env["DATABASEPASS"]);

$username = $_POST['usr'];
$password = $_POST['pswd'];
$_SESSION['usr'] = $username;
$_SESSION['pswd'] = $password;

if ($user->exists($username, $password)) {
    $_SESSION['login'] = true;
    echo "VALID: welcome \n".$username."...";
    echo "\n redirecting";
    header("location: login.php");
} else {
    echo "INVALID: username or password...";
    echo "\n redirecting";
    header("Location: index.html");
}