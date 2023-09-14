<?php
//flips the value of a session variable to show or hide read letters
session_start();
if ($_SESSION['showmarkRead'] != NULL) {
    if ($_SESSION['showmarkRead'] === True) {
        $_SESSION['showmarkRead'] = False;
    } else {
        $_SESSION['showmarkRead'] = True;
    }
}
?>