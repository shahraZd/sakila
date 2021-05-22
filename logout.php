<?php
//logout.php  
setcookie("username", "", time() - 3600);

header("location:login.php");
