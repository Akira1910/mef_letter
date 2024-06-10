<?php
session_start();

unset($_SESSION["login"]);
unset($_SESSION["uid"]);
unset($_SESSION["usrlevel"]);
unset($_SESSION["fullname"]);

header("Location: index.php");
exit();
?>
