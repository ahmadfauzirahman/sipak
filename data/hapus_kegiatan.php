<?php
require_once 'sesi.php';
require_once 'koneksi.php';

if (isset($_REQUEST['id_keg'])) {
	$id_keg = $_REQUEST['id_keg'];
	$sql = "DELETE FROM kegiatan WHERE id_keg=$id_keg";
	$stmt = $connect->prepare($sql);
	$stmt->execute(); 
	
	header('Location:../home.php?view=kegiatan');
} else {
	echo 'Parameter id harus ada';
}
?>