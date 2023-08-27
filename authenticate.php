<?php
session_start(); // Start the session to store session variables

// enable debugging error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'User.php';

$env = parse_ini_file('../.env');

$user = new User($env['DATABASENAME'], $env['URL'], $env['DATABASEUSR'], $env['DATABASEPASS']);

$username = $_POST['usr'];
$password = $_POST['pswd'];

// Store username and password in session variables
$_SESSION['usr'] = $username;
$_SESSION['pswd'] = $password;

if ($user->exists($username, $password)) {
    // change session variable for login to true
    // this is later used to ensure if the login.php page is navigated to without a logged in account, it will redirect to the login page
    $_SESSION['login'] = true;
    // redirect to the desired page after successful login
    header('Location: login.php'); 
}
else {
    // redirect to login page again if login is false
    header('Location: index.html');
}
?>
