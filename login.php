<?php
session_start();
if (!isset($_SESSION['login']) == null or !isset($_SESSION['login']) == False) {
    header("Location: index.html?message=".urlencode('please login first'));
}
include 'User.php';
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
        $letter = $user->getLetter($_SESSION["usr"]);
        ?>
        <p>Below is your latest letter:</p>
        <p>contents <br/> <?php echo $letter; ?> <br/> end</p>
    </div>
    <script src="script.js"></script>
</body>
</html>