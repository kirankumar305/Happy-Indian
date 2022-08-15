<?php
session_start();
unset($_SESSION['happy_email_ses']);
header('location:index.php');
 ?>