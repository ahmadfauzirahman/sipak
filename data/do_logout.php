<?php
session_name('sipak');
session_start();

$_SESSION = array();

header('Location:../index.php');
?>