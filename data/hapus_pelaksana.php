<?php
require_once 'sesi.php';
require_once 'koneksi.php';

if (isset($_REQUEST['id_plk'])) {
	$id_plk = $_REQUEST['id_plk'];

	$sql2 = "SELECT id_keg FROM pelaksana WHERE id_plk=$id_plk";
	$stmt2 = $connect->prepare($sql2);
	$stmt2->execute(); 
	$y = $stmt2->fetch();
	echo 

	$sql = "DELETE FROM pelaksana WHERE id_plk=$id_plk";
	$stmt = $connect->prepare($sql);
	$stmt->execute(); 
	
	header('Location:../home.php?view=edit_kegiatan&id_keg='.$y['id_keg']);
} else {
	echo 'Parameter id harus ada';
}
?>