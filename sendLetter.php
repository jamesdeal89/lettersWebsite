<?php

session_start(); // Start the session to store session variables

// enable debugging error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'User.php';

$env = parse_ini_file('.env');

$user = new User($env["DATABASENAME"], $env["URL"], $env["DATABASEUSR"], $env["DATABASEPASS"]);

// get the letter content the user submitted
$toBox = $_POST['toBox'];
$contentBox = $_POST['contBox'];

// check if that adressee exists 
if ($user->addressExists($toBox)){
    // if adressee exists, add the letter to the letters table
    $user->sendLetter($toBox,$contentBox);
    echo "Letter has been sent!";
}
else {
    // if adressee does not exist, tell user to retry
    echo "Invalid adressee... retry";
}

?>