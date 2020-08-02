<?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com/
*/
?>

<?php
session_start();
if(!isset($_SESSION["UserID"])){
header("Location: login.php");
exit(); }
?>
