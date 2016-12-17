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
    <title>
      <?php echo $config->site_title ?>
    </title>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
  <script type="text/javascript">
    function checkForm(form)
    {
      if(!form.captcha.value.match(/^\d{5}$/)) {
        alert('Please enter the CAPTCHA digits in the box provided');
        form.captcha.focus();
        return false;
      }
      return true;
    }
  </script>
  </head>
  
  <body>
    <?php include('navigation.php'); ?>
    <div class="container">
      <div class="starter-template">
        <h1>
          Welcome to SS Pharmacy <?php print  $_SESSION['uNm'];?>
        </h1>
        <div class="row">
          <?php if ($succ) echo "<div class=\"alert alert-success\">".$succ."</div>" ?>
          <?php if ($err) echo "<div class=\"alert alert-danger\">".$err."</div>" ?>
          <div class="col-md-3">
            <div class="well">

              <?php if (!isset($_SESSION['uNm'])): ?>
                <?php if(isset($_SESSION['valid_user']) && !$_SESSION['valid_user']):?>
                  <div style="color:red;">Invalid User Credentials. Please Try Again!</div>
                <?php endif; ?>
                <div>Please Login to Access Reports.</div>
                <form method="post" action="login.php" onsubmit="return checkForm(this);">
                  <div class="form-group">
                  <label>
                    Login Id
                  </label>
                  <input type="text" name="loginid" class="form-control">
                  </div>
                  <div class="form-group">
                  <label>
                    Password
                  </label>
                  <input type="password" name="password" class="form-control">
                  </div>
                  <p><img src="/captcha.php" width="120" height="30" border="1" alt="CAPTCHA"></p>
                  <p><input type="text" size="6" maxlength="5" name="captcha" value=""><br>
                  <small>copy the digits from the image into this box</small></p>
                  <button type="submit" class="btn btn-primary" name="form_action">
                  Login
                  </button>
                </form>
              <?php else: ?>
                <form method="post" action="logout.php">
                  <button type="submit" class="btn btn-primary" name="form_action">
                  Logout
                  </button>
                </form>
              <?php endif; ?>
            </div>
            <hr>
            <!--
            <p>No account? <a href="register.php">Register</a></p>
            <p>Forgot? <a href="reset.php">Reset your password</a>.</p>
            -->
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