<?php
session_start();
include('config.php');

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
        Admin Reports
        </h1>
        
        <div class="row">
          <div class="col-md-10">
            <p><a href="report-generics.php" class="btn">Generics</a></p>
            <p><a href="report-products.php" class="btn">Products</a></p>
            <p><a href="report-manufacturers.php" class="btn">Manufacturers</a></p>
            <p><a href="report-distributors.php" class="btn">Distributors</a></p>
            <p><a href="report-doctors.php" class="btn">Doctors</a></p>
            <p><a href="report-customers.php" class="btn">Customers</a></p>
            <p><a href="report-employees.php" class="btn">Employees</a></p>
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