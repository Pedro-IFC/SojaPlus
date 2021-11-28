<?php
session_start();
unset($_SESSION['idSojaPlusUser']);
header('location:../login.php'); //trocar para login
?>