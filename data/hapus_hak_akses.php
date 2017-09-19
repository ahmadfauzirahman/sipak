<?php
require_once 'sesi.php';
require_once 'koneksi.php';

if (isset($_REQUEST['id_user'])) {
	$id_user = $_REQUEST['id_user'];
	$sql = "DELETE FROM user WHERE id_user=$id_user";
	$stmt = $connect->prepare($sql);
	$stmt->execute(); 
	
	header('Location:../home.php?view=hak_akses');
} else {
	echo 'Parameter id harus ada';
}
?>