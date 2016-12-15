<?php

include('config.php');
/*session_start();



if (!$user->authenticated)
{
  header('Location: index.php');
  die();
}
$u = $db->query("SELECT * FROM minty_users WHERE ID > 0");
*/



$conn = sqlsrv_connect( $serverName, $connectionInfo);
$rowsPerPage = 100;



$tsql = "SELECT COUNT(SalesManID) FROM dbo.SalesMen"; 
/* Execute the query. */ 
$stmt = sqlsrv_query($conn, $tsql); 
if($stmt === false) 
{ 
    echo "Error in query execution."; 
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

$tsql = "SELECT * FROM (SELECT ROW_NUMBER() OVER(ORDER BY SalesManID)  AS RowNumber,  EmployeeId,   Name, Phone, Salary, LoginId, Role  FROM dbo.SalesMen)  AS Temp WHERE RowNumber BETWEEN ? AND ?"; 
   
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
    echo "Error in query execution."; 
    die( print_r( sqlsrv_errors(), true)); 
} 
/* Display results. */ 
$data_rows = "";
while($row = sqlsrv_fetch_array($stmt2) ) 
{ 
     $data_rows = $data_rows . "<tr> <td>" . $row[1] . "</td> <td>" . $row[2] ." </td> <td>" . $row[3]   ." </td> <td>" . $row[4] . " </td> <td>" . $row[5] . " </td> <td>" . $row[6] . " </td> <td>" . $row[7] . " </td> <td>" . $row[8] . " </td> <td>" . $row[9] . " </td> <td>" . $row[10] . " </td> <td>" . $row[11] . " </td> <td>" . $row[12] . " </td> <td>" . $row[13] . " </td> <td>" . $row[14] . "</td> </tr>"; 
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
    <?php include('navigation.php'); ?>
    <div class="container">
      <div class="starter-template">
        <h1>
          Employees List
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
          <th>EmployeeId</th>
          <th>Name</th>
          <th>Phone</th>
          <th>Salary</th>
          <th>LoginId</th>
          <th>Role</th>
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
