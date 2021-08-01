<?php
ob_start();
$website_title = 'Change Password';
include 'includes/init.php';
include 'includes/templates/head.php';
include 'includes/templates/topbar.php';
include 'includes/templates/header.php';
include 'includes/templates/nav.php';
LoggedOutRedirect();
$error_msg = '';
$hide_box = '';
$show_box = "display:none;";


if (!empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['password_confirm'])){

    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $password_confirm = $_POST['password_confirm'];

    $username = getUsernameDetail($_SESSION['user_id']);

    if(password_verify($old_password, checkUserPassword($username))) {
        if($new_password == $password_confirm){
            changePassword($_SESSION['user_id'], $password_confirm);
            $show_box = 'display:block;';
            $hide_box = "style='display:none;'";
        } else {
            $error_msg = 'Your new passwords do not match'; 
        }
        
    } else {
        $error_msg = 'Incorrect old password';
    }

}


?>

<div class="mainContent container text-center">
<h3>Change Password</h3>
<b style="color: red;"><?php echo $error_msg; ?></b>
<form action="changepassword.php" method="POST" <?php echo $hide_box; ?>>
    <div class="form-group">
        <label for="password">Old Password</label>
        <input type="password" class="form-control" id="old_password" name="old_password" required>
    </div>
    <div class="form-group">
        <label for="password">New Password</label>
        <input type="password" class="form-control" id="new_password" name="new_password" required>
    </div>
    <div class="form-group">
        <label for="password_confirm">Confirm New Password</label>
        <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
    </div>
    <button type="submit" class="btn btn-outline-secondary">Change Password</button>
    </form>
    <b style="color: green; <?php echo $show_box; ?>">Your password has been changed successfully.</b>
</div>
<?php include 'includes/templates/footer.php';?>