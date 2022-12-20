<?php
if (!isset($_SESSION['profile']) || $_SESSION['profile'] != "Administrador") { header("location: permissionscheck.php"); }
?>