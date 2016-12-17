session_start();
if((isset($_SESSION['valid_user']) && !$_SESSION['valid_user'])  || (!isset($_SESSION['valid_user']))) {
  header('Location: index.php');
  die();
}