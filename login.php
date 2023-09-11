<?php
include 'User.php';
session_start();
if (($_SESSION['login']) == null or ($_SESSION['login']) == False) {
    header('Location: index.html?message='.urlencode('please login first'));
}
?>

<html>
<head>

    <link rel='icon' type='image/x-icon' href='favicon.ico'>
    <title>LetterWebsite</title>
    <link rel='stylesheet' href='./style.css'/>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Borel'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Oxygen'>

    <script src='./script.js' defer></script>
</head>
<body>
    <div id='main'>
        <h1>Welcome <?php echo $_SESSION['usr']; ?></h1>
        <?php
        $env = parse_ini_file('../.env');
        $user = new User($env['DATABASENAME'], $env['URL'], $env['DATABASEUSR'], $env['DATABASEPASS']);
        ?>
        <div>
            <form action='./logout.php' method='post'>
                <input class="button" type='submit' value='Log-Out'>
            </form>
        </div>

        <p>Below is your latest letter:</p>
        <div id='letter' onclick='openLetter()'>
            <p id='contents'>
            
            <?php 
            // parse the letter database data and find the specific user's letters and display them
            $user->getLetter($_SESSION['usr']);
            ?> 
            
            </p>
        </div>
        <div style='text-align:center'>
        <br>
        <hr>
        <br>
        <button id='showSend' onclick='showForm()'>Send a letter?</button>
        </div>
        <div id='send'>
            <p>Below you can send a letter:</p>
            <form action='sendLetter.php' method='post' accept-charset=utf-8>
                <label for='toBox'>To?:</label>
                <input type='text' required=True id='toBox' name='toBox'><br><br>
                <label for='contBox'>Content?:</label>
                <div style='text-align:center'>  
                <textarea id='contBox' name='contBox' rows='5' cols='40'></textarea>
                </div>
                <label for="delay">Lock letter for 48 hours?</label>
                <input type="checkbox" id="delay" name="delay" value="delay"><br>
                <input class="button" type='submit' id='submit' name='submit'><br><br>
            </form>
        </div>
    </div>

</body>

</html>
