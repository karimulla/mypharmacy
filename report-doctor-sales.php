<?php

include('config.php');
include('verify-login-status.php');




$conn = sqlsrv_connect( $serverName, $connectionInfo);



//get all distributor names
$distributor_names = ""; 
$tsql0 = "SELECT DoctorName FROM dbo.Doctors"; 
$stmt0 = sqlsrv_query($conn, $tsql0); 
if($stmt0) 
{ 
  while($row = sqlsrv_fetch_array($stmt0) ) 
  { 
       if($_GET['name'] == $row[0]) {
          $distributor_names = $distributor_names . '<option selected="selected" value="' . $row[0].'">' . $row[0] .'</option>'; 
       } else {
          $distributor_names = $distributor_names . '<option value="' . $row[0].'">' . $row[0] .'</option>';
       }
       
  }
} 


//display all data  

$tsql = "select j1.BillNo,j2.Name,j2.PhoneNumber,j3.Name,j1.TotalDiscount,j1.TotalGrossPrice,j1.TotalPrice,j1.TotalTaxAmount , j7.StartDate from Orders j1 join Clients j2 on j1.ClientID = j2.ClientID join SalesMen j3 on j1.SalesManID = j3.SalesManID join Stores j5 on j5.StoreID = j1.StoreID join (select distinct(OrderInfoes.OrderID), StartDate from OrderInfoes ) j7 on j7.OrderID= j1.OrderID join Doctors j8 on j8.DoctorID = j1.DoctorID where j1.ClientType =1 and ((select count (ReturnOrderInfoID) from OrderInfoes j6 join Orders on j1.OrderID = j6.OrderID where j6.ReturnOrderInfoID is null or j6.ReturnOrderInfoID =0 )<=0) and j7.StartDate between ? and ?";
//and j1.DoctorID = ? 
/* Determine which row numbers to display. */ 
//print $rowsPerPage . "low" . $lowRowNum . "high:" . $highRowNum;

$fromDate1 = strtotime($_GET['fromDate']);
$fromDate = date('Y-m-d',$fromDate1);

$toDate1 = strtotime($_GET['toDate']);
$toDate = date('Y-m-d',$toDate1 );

$params = array(&$fromDate, &$toDate);

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
     $orderDate  = "";
     if($row[8] != "") {
         $date = date_create($row[8]->date);
        $orderDate  =date_format($date, 'd/m/y');
     }
     $data_rows = $data_rows . "<tr> <td>" . $row[0] . "</td> <td>" . $row[1] ." </td> <td>" . $row[2] . "</td> <td>" . $row[3] . "</td> <td>" . $row[4] . "</td> <td>" . $row[5] . "</td> <td>" . $row[6] . "</td> <td>" . $row[7] . "</td> <td>" . $orderDate . "</td> </tr>"; 
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
          Doctor wise sales Report
        </h1>

        <div class="row">
          <div class="col-md-10">
          <form action="report-doctor-sales.php">
            From:
            <input type="date" name="fromDate">
            <input type="date" name="toDate">   
            <br><br>
            <select name="name">
              <?php print $distributor_names; ?>
            </select>         
            <input type="submit">
          </form>

          </div>
        </div>
        
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
          
          <th>Order No</th>
          <th>Customer name</th>
          <th>Phone Number</th>
          
          <th>Employee Name</th>
          <th>Total Discount</th>
          <th>Total GrossPrice</th>
          <th>Total Price</th>
          <th>Total TaxAmount</th>
          <th>Order Date</th>


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

