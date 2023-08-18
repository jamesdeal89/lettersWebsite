<?php
include 'User.php';
session_start();
if (!isset($_SESSION['login']) == null or !isset($_SESSION['login']) == False) {
    header("Location: index.html?message=".urlencode('please login first'));
}
?>

<html>
<head>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Borel">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oxygen">
</head>
<body>
    <div id="main">
        <h1>Welcome <?php echo $_SESSION["usr"]; ?></h1>
        <?php
        $env = parse_ini_file('.env');
        $user = new User($env["DATABASENAME"], $env["URL"], $env["DATABASEUSR"], $env["DATABASEPASS"]);
        $letter = $user->getLetter();
        ?>
        <p>Below is your latest letter:</p>
        <div id="letter" onclick="openLetter()">
            <p id="contents">contents <br/> <?php echo $letter; ?> <br/> end</p>
        </div>
    </div>
<script src="script.js"></script>
</body>

</html>