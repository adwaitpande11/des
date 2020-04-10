<?php
session_start();
setcookie("user_id", "0", time()-3600);
setcookie("username", "0", time()-3600);
unset($_SESSION['user_id']);
unset($_SESSION);
session_destroy();
header("location: index.php");
exit;
?>