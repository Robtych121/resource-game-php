<?php
ob_start();
$website_title = 'Home';
include 'includes/init.php';
include 'includes/templates/head.php';
include 'includes/templates/topbar.php';
include 'includes/templates/header.php';
include 'includes/templates/nav.php';
LoggedOutRedirect();
?>

<p>homepage</p>
<a href="logout.php">Logout</a>
<?php include 'includes/templates/footer.php';?>