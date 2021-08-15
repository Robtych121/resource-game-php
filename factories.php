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

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Factories</h1>
            <hr>
            <p class="text-center">Please see below your factories</p>
        </div>
    </div>
</div>
<?php include 'includes/templates/footer.php';?>