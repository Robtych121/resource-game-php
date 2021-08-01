<?php
ob_start();
$website_title = 'Activate Account';
include 'includes/init.php';
include 'includes/templates/head.php';
include 'includes/templates/topbar.php';
include 'includes/templates/header.php';
# include 'includes/templates/nav.php';
LoggedInRedirect();
$error_msg = '';
$show_box = "display:none;";

if(isset($_GET["akey"])){
    $activationKey = $_GET['akey'];

    if(activateAccount($activationKey) == true){
        clearActivationKey($activationKey);
        $show_box = 'display:block;';
    } else {
        $error_msg = 'There was a problem, please contact admin';
    };
} else {
    $error_msg = 'You need a key to activate an account';
}




?>
<div class="mainContent container">
  <div class="row">
    <div class="col-md-6 text-center ml-auto mr-auto login_form">
    <h3>Account Activation</h3>
    <b style="color: red;"><?php echo $error_msg; ?></b>
    <b style="color: green; <?php echo $show_box; ?>">Your account has been activated.<br><a href="login.php">Click Here to Login</a></b>
    </div>
  </div>
</div>
<?php include 'includes/templates/footer.php';?>