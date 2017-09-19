<?php
require_once 'sesi.php';
require_once 'koneksi.php';

if (isset($_REQUEST['id_keg'])) {
	$id_keg = $_REQUEST['id_keg'];
} else {
	$id_keg = 0;
}

$aksi = $_REQUEST['aksi'];

if ($aksi == "setuju") {
	$sql = "UPDATE kegiatan SET 
		status_keg='Disetujui Direktur'
		WHERE id_keg=$id_keg";

} else {
	$sql = "UPDATE kegiatan SET 
		status_keg='Ditolak Direktur'
		WHERE id_keg=$id_keg";
}
$stmt = $connect->prepare($sql);
$stmt->execute(); 

header('Location:../home.php?view=kegiatan');
?>