<?php
require_once 'sesi.php';
require_once 'koneksi.php';

if (isset($_REQUEST['id_lap'])) {
	$id_lap = $_REQUEST['id_lap'];
	$sql = "DELETE FROM laporan WHERE id_lap=$id_lap";
	$stmt = $connect->prepare($sql);
	$stmt->execute(); 
	
	header('Location:../home.php?view=laporan');
} else {
	echo 'Parameter id harus ada';
}
?>