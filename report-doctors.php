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
$rowsPerPage = 100;



$tsql = "SELECT COUNT(DoctorID) FROM dbo.Doctors"; 
/* Execute the query. */ 
$stmt = sqlsrv_query($conn, $tsql); 
if($stmt === false) 
{ 
    echo "Error in query execution1."; 
    die( print_r( sqlsrv_errors(), true)); 
}
$data_pagination = "";
/* Get the number of rows returned. */ 
$rowsReturned = sqlsrv_fetch_array($stmt); 
if($rowsReturned === false) 
{ 
    echo "Error in retrieving number of rows."; 
    die( print_r( sqlsrv_errors(), true)); 
} 
elseif($rowsReturned[0] == 0) 
{ 
    echo "No rows returned."; 
} 
else 
{     
    /* Display page links. */ 
    $numOfPages = ceil($rowsReturned[0]/$rowsPerPage); 
    for($i = 1; $i<=$numOfPages; $i++) 
    { 
        $pageNum = "?pageNum=$i"; 
        $data_pagination = $data_pagination . "<a href=$pageNum>" . $i. "</a>&nbsp;&nbsp;"; 
    } 

}




//display data 

$tsql = "SELECT * FROM (SELECT ROW_NUMBER() OVER(ORDER BY DoctorID)  AS RowNumber,  DoctorName,   Gender, Age, RegNo, Specialization, Qualification,  HospitalName  FROM dbo.Doctors)  AS Temp WHERE RowNumber BETWEEN ? AND ?"; 

        
/* Determine which row numbers to display. */ 
$rowsPerPage = 100;
$lowRowNum = 1; 
$highRowNum = $rowsPerPage; 

if(isset($_GET['pageNum'])) {
  $highRowNum = $_GET['pageNum']  * $rowsPerPage;
  $lowRowNum = $highRowNum - $rowsPerPage +1;  
} 
//print $rowsPerPage . "low" . $lowRowNum . "high:" . $highRowNum;


/* Set query parameter values. */ 
$params = array(&$lowRowNum, &$highRowNum);

/* Execute the query. */ 
$stmt2 = sqlsrv_query($conn, $tsql, $params); 
if($stmt2 === false) 
{ 
    echo "Error in query execution2."; 
    die( print_r( sqlsrv_errors(), true)); 
} 
/* Display results. */ 
$data_rows = "";
while($row = sqlsrv_fetch_array($stmt2) ) 
{ 
     $data_rows = $data_rows . "<tr> <td>" . $row[1] . "</td> <td>" . $row[2] ." </td> <td>" . $row[3] . "</td> </tr>"; 
}







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
        
        <table class="table">
      <thead>
        <tr>          
          <th>DoctorName</th>
          <th>Gender</th>
          <th>Age</th>
          <th>RegNo</th>
          <th>Gender</th>
          <th>Specialization</th>
          <th>Qualification</th>
          <th>HospitalName</th>
        </tr>
      </thead>
      <tbody>
        <?php print $data_rows; ?> 
        
      </tbody>
    </table>
      <?php print $data_pagination; ?>

      </div>
    </div>
    <!-- /.container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
    </script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js">
    </script>
  </body>

</html>



