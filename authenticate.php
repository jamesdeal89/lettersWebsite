<?php
// enable debugging error reporting

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start the session to store session variables

include 'User.php';

$env = parse_ini_file('.env');

$user = new User($env["DATABASENAME"], $env["URL"], $env["DATABASEUSR"], $env["DATABASEPASS"]);

$username = $_POST['usr'];
$password = $_POST['pswd'];

// Store username and password in session variables
$_SESSION['usr'] = $username;
$_SESSION['pswd'] = $password;

if ($user->exists($username, $password)) {
    $_SESSION['login'] = true;
    header("Location: login.php"); // Redirect to the desired page after successful login
} else {
    header("Location: index.html"); // Redirect to the desired page after unsuccessful login
}
?>