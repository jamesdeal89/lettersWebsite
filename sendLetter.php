<?php

session_start(); // Start the session to store session variables

// enable debugging error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'User.php';

$env = parse_ini_file('../.env');

$user = new User($env["DATABASENAME"], $env["URL"], $env["DATABASEUSR"], $env["DATABASEPASS"]);

// get the letter content the user submitted
$toBox = $_POST['toBox'];
$contentBox = $_POST['contBox'];

// check if that adressee exists 
if ($user->addressExists($toBox)){
    // if adressee exists, add the letter to the letters table
    $user->sendLetter($toBox,$contentBox);
    echo "Letter has been sent!";
    // below uses echo to run a script which adds a time delay before redirect, this is as PHP's sleep() does not affect header() redirects
    echo "<script>setTimeout(function(){ window.location.href = 'login.php'; }, 2000);</script>";
}
else {
    // if adressee does not exist, tell user to retry
    echo "Invalid adressee... retry";
    echo "<script>setTimeout(function(){ window.location.href = 'login.php'; }, 2000);</script>";
}

?>
