<?php
session_start();
if (!isset($_SESSION['login_admin']) || $_SESSION['login_admin'] != true) { header ("location: login.php"); }
?>