<?php
session_start();
ob_start();

# System related functions
require ('config/db_connection.php');
require ('functions/general.php');
require ('functions/user.php');
require ('functions/emails.php');
?>