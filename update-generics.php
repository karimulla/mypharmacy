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

$genericID = $_GET['genricID'];

print "Generic ID: " . $genericID;

//display data 

$tsql = "SELECT Prod_GenricID,  GenricName,   GenricCode, GenricRemarks  FROM dbo.Product_Generic WHERE Prod_GenricID = ? "; 


/* Set query parameter values. */ 
$params = array($genericID);

/* Execute the query. */ 
$stmt2 = sqlsrv_query($conn, $tsql, $params); 
if($stmt2 === false) 
{ 
    echo "Error in query execution."; 
    die( print_r( sqlsrv_errors(), true)); 
} 
/* Display results. */ 
$data_rows = "";
$genericName = "";
$genericCode = "";
$genericRemarks = "";
while($row = sqlsrv_fetch_array($stmt2) ) 
{ 
    $genericCode = $row[1];
    $genericName = $row[2];
    $genericRemarks = $row[3]; 
}

print "Generic ID2: " . $genericID;
$formData = '<form name="form" method="POST" action="update-generics-submit.php">' . 
        'Generic Name: <input type="text" name="genericName" value="' . $genericName . '"/> <br>' .
        'Generic Code: <input type="text" name="genericCode" value="' . $genericCode . '"/> <br>'  .
        'Generic Remarks: <input type="text" name="genericRemarks" value="' . $genericRemarks . '"/><br><br> '.
              ' <input type="hidden" name="genericId" value="'. $genericID . '"> '.
              '<input type="submit"  value="submit"> ' .
        '</form> ';


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
           
             <!-- <h3>
              Welcome, <?php //echo $user->username ?>.
            </h3> 
            <p>
              <a href="index.php?action=logout" class="btn btn-danger">Log Out</a>
            </p> -->
          </div>
          
        </div>
        
       
        <div id="formData">  <?php print $formData; ?></div>

        
      
     
      </div>
    </div>
    <!-- /.container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
    </script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js">
    </script>
  </body>

</html>



