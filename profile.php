<?php
ob_start();
$website_title = 'Your Profile';
include 'includes/init.php';
include 'includes/templates/head.php';
include 'includes/templates/topbar.php';
include 'includes/templates/header.php';
include 'includes/templates/nav.php';
include 'includes/templates/statusbars.php';
LoggedOutRedirect();
?>

<div class="mainContent container text-center">
    <h3>Your Profile - <?php echo getUsernameDetail($_SESSION['user_id']); ?></h3>
    <p><b>Email:</b> <?php echo getUserEmail($_SESSION['user_id']); ?></p>
    <a class="btn btn-outline-primary" href="changepassword.php">Change Password</a>
</div>
<?php include 'includes/templates/footer.php';?>