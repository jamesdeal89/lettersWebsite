<?php
//flips the value of a session variable to show or hide read letters
session_start();
if ($_SESSION['showmarkRead'] == 1) {
    $_SESSION['showmarkRead'] = 0;
} else {
    $_SESSION['showmarkRead'] = 1;
}

header("Location: ./login.php");
?>