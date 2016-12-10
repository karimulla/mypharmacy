<?php

//include('config.php');
/*session_start();



if (!$user->authenticated)
{
  header('Location: index.php');
  die();
}
$u = $db->query("SELECT * FROM minty_users WHERE ID > 0");
*/



$serverName = "sql5019.SmarterASP.NET"; //serverName\instanceName
$connectionInfo = array( "Database"=>"db_a0fdb5_mirakql", "UID"=>"DB_A0FDB5_mirakql_admin", "PWD"=>"mirakql1");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$genericID = $_POST['genericId'];


/* Display results. */ 
$genericName = $_POST['genericName'];
$genericCode = $_POST['genericCode'];
$genericRemarks = $_POST['genericRemarks'];

$tsql = "UPDATE dbo.Product_Generic SET GenricName = ?, GenricCode=?, GenricRemarks=? WHERE Prod_GenricID= ?"; 

/* Set query parameter values. */ 
$params = array(&$genericName, &$genericCode, &$genericRemarks, &$genericID);

$stmt2 = sqlsrv_query($conn, $tsql, $params); 

if( $stmt2 === false ) {
     die( print_r( sqlsrv_errors(), true));
}

print "geric name:  " . $genericName;
print "geric code:  " . $genericCode;
print "geric remarkts:  " . $genericRemarks;
print "geric id:  " . $genericID;



?>
<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php //echo $config->meta_description ?>">
    <meta name="keywords" content="<?php //echo $config->meta_keywords ?>">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">
    <title>
      <?php //echo $config->site_title ?>
    </title>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  </head>
  
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">My Pharmacy</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active">
              <a href="#">Home</a>
            </li>
            <li>
              <a href="report.php">Reports</a>
            </li>
            <li>
              <a href="#contact">Contact</a>
            </li>
          </ul>
        </div>
        <!--/.nav-collapse -->
      </div>
    </div>
    <div class="container">
      <div class="starter-template">
        <h1>
          Members Area
        </h1>
        
        <div class="row">
          <div class="col-md-10">
           
             Data Updated
          </div>
          
        </div>
       
     
      </div>
    </div>
    <!-- /.container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
    </script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js">
    </script>
  </body>

</html>



