<?php

session_start();
include('config.php');

if($_REQUEST['captcha'] != $_SESSION['captcha']) {
  header('Location: index.php?captcacode=invalid');
  die("Sorry, the CAPTCHA code entered was incorrect!");
}

$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn === false){
    echo "Error in connection.\n";
    die( print_r( sqlsrv_errors(), true));
}
$username = $_REQUEST['loginid'];
$password  = $_REQUEST['password'];
$tsql = "SELECT * FROM dbo.SalesMen WHERE LoginId='$username' AND Password='$password'";
$stmt = sqlsrv_query($conn, $tsql); 
if($stmt === false) 
{ 
    echo "Error in query execution1."; 
    die( print_r( sqlsrv_errors(), true)); 
}
$rowsReturned = sqlsrv_fetch_array($stmt); 
if($rowsReturned === false) 
{ 
    echo "Error in retrieving number of rows."; 
    die( print_r( sqlsrv_errors(), true)); 
} 
elseif($rowsReturned[0] == 0) 
{ 
    $_SESSION['valid_user'] = false;
    unset($_SESSION['uNm']);
    header('Location: index.php');
    die();
} else {
    $_SESSION['valid_user'] = true;
    $_SESSION['uNm'] = $username;
    header('Location: index.php');
    die();
}
?>
