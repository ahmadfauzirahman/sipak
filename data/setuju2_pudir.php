<?php
require_once 'sesi.php';
require_once 'koneksi.php';

if (isset($_REQUEST['id_lap'])) {
	$id_lap = $_REQUEST['id_lap'];
} else {
	$id_lap = 0;
}

$aksi = $_REQUEST['aksi'];

if ($aksi == "setuju") {
	$sql = "UPDATE laporan SET 
		status_lap='Menunggu Persetujuan Direktur'
		WHERE id_lap=$id_lap";

} else {
	$sql = "UPDATE laporan SET 
		status_lap='Ditolak Pudir'
		WHERE id_lap=$id_lap";
}
$stmt = $connect->prepare($sql);
$stmt->execute(); 

header('Location:../home.php?view=laporan');
?>