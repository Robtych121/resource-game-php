<?php
ob_start();
$website_title = 'Recover Account';
include 'includes/init.php';
include 'includes/templates/head.php';
include 'includes/templates/topbar.php';
include 'includes/templates/header.php';
# include 'includes/templates/nav.php';
LoggedInRedirect();
$error_msg = '';
$hide_box = '';
$show_box = "display:none;";

if(isset($_GET["akey"]) || isset($_POST["recoveryKey"]) ){
  if (!empty($_POST['password']) && !empty($_POST['password_confirm']))
  {
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $recoveryKey = $_POST['recoveryKey'];

    if($password == $password_confirm){
      if(recoverAccount($password_confirm, $recoveryKey) == true){
        clearRecoveryKey($recoveryKey);
        $show_box = 'display:block;';
        $hide_box = "style='display:none;'";
      } else {
          $error_msg = 'There was a problem, please contact admin';
      };
    } else {
      $error_msg = "Password do not match";
    }
  }
} else {
    $error_msg = 'You need a key to recover an account';
}
?>
<div class="mainContent container">
  <div class="row">
    <div class="col-md-6 text-center ml-auto mr-auto login_form">
    <h3>Account Recovery</h3>
    <b style="color: red;"><?php echo $error_msg; ?></b>
    <form action="recover-password.php" method="POST" <?php echo $hide_box; ?>>
    <div class="form-group">
        <label for="recoveryKey">Recovery Key</label>
        <input type="text" class="form-control" id="recoveryKey" name="recoveryKey" value="<?php if(isset($_GET["akey"])){ echo $_GET['akey'];} if(isset($_POST["recoveryKey"])){ echo $_POST['recoveryKey'];}  ?>" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="password_confirm">Confirm Password</label>
        <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
      </div>
    <button type="submit" class="btn btn-outline-secondary">Recover</button>
    </form>
    <b style="color: green; <?php echo $show_box; ?>">Your password has been changed successfully.<br><a href="login.php">Click Here to Login</a></b>
    </div>
  </div>
</div>
<?php include 'includes/templates/footer.php';?>