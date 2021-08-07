<?php
ob_start();
$website_title = 'Login';
include 'includes/init.php';
include 'includes/templates/head.php';
include 'includes/templates/topbar.php';
include 'includes/templates/header.php';
# include 'includes/templates/nav.php';
LoggedInRedirect();
$error_msg = '';
if (!empty($_POST['username']) && !empty($_POST['password']))
   {
      $username = $_POST['username'];
      $password = $_POST['password'];


      if(checkUserIsActive($username) == '0'){
        $error_msg .= "<p>You need to activate your account.</p>";
      } else {
        if(password_verify($password, checkUserPassword($username))) {
          $user_id = getUserIDFromDB($username, checkUserPassword($username));
  
          $_SESSION["loggedin"] = true;
          $_SESSION["user_id"] = $user_id;
          header('Location: index.php');
        } else {
          $error_msg .= "<p>Couldn't log you in, please check your details</p>";
        }
      }

      
   }
?>
<div class="mainContent container">
  <div class="row">
    <div class="col-md-6 text-center ml-auto mr-auto login_form">
    <h3>Login</h3>
    <b style="color: red;"><?php echo $error_msg; ?></b>
    <form action="login.php" method="POST">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <button type="submit" class="btn btn-outline-secondary">Login</button>
      <a class="btn btn-outline-secondary" href="recover.php">Forgot Password?</a>
      <hr>
      <a class="btn btn-outline-primary" href="register.php">Register</a>
    </form>
    </div>
  </div>
</div>
<?php include 'includes/templates/footer.php';?>