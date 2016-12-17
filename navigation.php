<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">My Pharmacy</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active">
              <a href="/">Home</a>
            </li>
            <li>
              <a href="admin.php">Admin Reports</a>
            </li>
            <li>
              <a href="reports.php">Reports</a>
            </li>
            <?php if((isset($_SESSION['valid_user']) && !$_SESSION['valid_user'])  || (!isset($_SESSION['valid_user']))): ?>
              <li><a href="/index.php">Login</a></li>
            <?php elseif: ?>
              <li><a href="/logout.php">Logout</a></li>
            <?php endif; ?>
          </ul>
        </div>
        <!--/.nav-collapse -->
      </div>
</div>
