<?php

include 'User.php';

$env = parse_ini_file('.env');

$user = new User($env["DATABASENAME"], $env["URL"], $env["DATABASEUSR"], $env["DATABASEPASS"]);

$username = $_POST['usr'];
$password = $_POST['pswd'];

if ($user->exists($username, $password)) {
    $_SESSION['login'] = true;
    echo "VALID: welcome \n".$username."...";
    echo "\n redirecting";
    sleep(3);
    header("location: login.php");
} else {
    echo "INVALID: username or password...";
    echo "\n redirecting";
    sleep(3);
    header("Location: index.html");
}