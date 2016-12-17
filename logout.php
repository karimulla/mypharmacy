<?php
session_start();
unset($_SESSION['valid_user']);
unset($_SESSION['uNm']);
header('Location: index.php');
die();
?>