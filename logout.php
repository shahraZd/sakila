<?php
// remove cookie
setcookie("username", "", time() - 3600);
//redirect to main page
header("location:login.php");
