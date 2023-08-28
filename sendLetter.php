<html>
<head>
    <link href='sendStyle.css' rel='stylesheet'/>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Oxygen'>
</head>
<body>  
<div class='mailbox' id='mb1'>
    <h3>
        <?php 
        session_start(); // Start the session to store session variables

        // enable debugging error reporting
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        include 'User.php';

        // get the letter content the user submitted
        $toBox = $_POST['toBox'];
        $contentBox = $_POST['contBox'];

        echo $_SESSION['usr'];

        ?>
    </h3>
</div>
<div class='mailbox' id='mb2'>
    <h3>
        <?php
        echo $toBox;
        ?>
    </h3>
</div>
<div id='envelope'></div>
<p>
<?php


$env = parse_ini_file('../.env');

$user = new User($env['DATABASENAME'], $env['URL'], $env['DATABASEUSR'], $env['DATABASEPASS']);


// check if that adressee exists 
if ($user->addressExists($toBox)){
    // if adressee exists, add the letter to the letters table
    $user->sendLetter($toBox,$contentBox);
    echo 'Letter has been sent!';
    // below uses echo to run a script which adds a time delay before redirect, this is as PHP's sleep() does not affect header() redirects
    echo '<script>setTimeout(function(){ window.location.href = "login.php"; }, 6000);</script>';
}
else {
    // if adressee does not exist, tell user to retry
    echo 'Invalid adressee... retry';
    echo '<script>setTimeout(function(){ window.location.href = "login.php"; }, 6000);</script>';
}

?>
</p>
</body>
</html>