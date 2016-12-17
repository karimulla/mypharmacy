<?php

session_start();
include('config.php');

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
    echo "Invalid User Name Password."; 
//    header('Location: index.php');
} else {
    echo "Valid User Name Password." . $username; 
    $_SESSION['valid_user'] = true;
    $_SESSION['uNm'] = $username;

//    header('Location: index.php');
    die();
}
?>
