<?php
session_name('sipak');
session_start();

if (!isset($_SESSION['nama'])) {
	header('Location:page/login.php');
}
?>