<?php
session_start();
require('function.php');
session_destroy();
echo"to login again <a href='login.php'>Click here</a>";
exit();
