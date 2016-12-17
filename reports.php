<?php
include('config.php');
include('verify-login-status.php');

?>
<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $config->meta_description ?>">
    <meta name="keywords" content="<?php echo $config->meta_keywords ?>">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">
    <title>Reports
    </title>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
  </head>
  
  <body>
    <?php include('navigation.php'); ?>
    <div class="container">
      <div class="starter-template">
        <h1>
        Reports
        </h1>
        
        <div class="row">
          <div class="col-md-10">
            <p><a href="report-purchases.php" class="btn">Purchases</a></p>
            <p><a href="report-product-purchases.php" class="btn">Product wise Purchases</a></p>
            <p><a href="report-distributor-purchases.php" class="btn">Distributor wise Purchases</a></p>
            <p><a href="report-stocks.php" class="btn">Stocks Not Done</a></p>
            <p><a href="report-purchases.php" class="btn">Manufacturer wise Stocks Not Done</a></p>
            <p><a href="report-purchases.php" class="btn">Product Wise Stocks Not Done</a></p>
            <p><a href="report-purchases.php" class="btn">Distributor wise Stocks Not Done</a></p>
            <p><a href="report-purchases.php" class="btn">Projected Expiry Stocks Not Done</a></p>
            <p><a href="report-purchases.php" class="btn">Expired Stocks Not Done</a></p>
            <p><a href="report-purchases.php" class="btn">Reached Minimum Stocks Not Done</a></p>
            <p><a href="report-sales.php" class="btn">Sales</a></p>
            <p><a href="report-doctor-sales.php" class="btn">Doctor wise Sales</a></p>
            <p><a href="report-patient-sales.php" class="btn">Patient wise Sales</a></p>
            <p><a href="report-product-sales.php" class="btn">Product wise Sales</a></p>
            <p><a href="report-distributor-sales.php" class="btn">Distributor wise Sales</a></p>
            <p><a href="report-opeator-sales.php" class="btn">Operator wise Sales</a></p>
            <p><a href="report-return-sales.php" class="btn">Return Sales List</a></p>
            <p><a href="report-return-sales.php" class="btn">Return Purchase List</a></p>
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