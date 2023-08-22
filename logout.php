<?php
session_start();
// invalidate session login token
$_SESSION["login"] = FALSE;
// redirect to home page
header("Location: ./index.html");
