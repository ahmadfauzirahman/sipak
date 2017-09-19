<?php
require_once 'sesi.php';
require_once 'koneksi.php';

if (isset($_REQUEST['id_lap'])) {
	$id_lap = $_REQUEST['id_lap'];
} else {
	$id_lap = 0;
}

$id_keg = $_REQUEST['id_keg'];
$status_lap = 'Draft';


$nama_folder="../foto/";
$tmp_foto = $_FILES['foto']['tmp_name'];
$type_foto = $_FILES['foto']['type'];
$nama_foto = $_FILES['foto']['name'];
$foto = $nama_folder.$nama_foto;   
move_uploaded_file($tmp_foto,$foto);   

$nama_folder2="../laporan/";
$tmp_laporan = $_FILES['laporan']['tmp_name'];
$type_laporan = $_FILES['laporan']['type'];
$nama_laporan = $_FILES['laporan']['name'];
$laporan = $nama_folder2.$nama_laporan;   
move_uploaded_file($tmp_laporan,$laporan);   

if ($id_lap == 0) {
	$sql = "INSERT INTO laporan (id_keg, judul_lap, tgl_lap, status_lap, foto) 
			VALUES ('$id_keg', '$nama_laporan', CURDATE(), '$status_lap', '$nama_foto')";
} else {
	if($tmp_foto == null && $type_foto == null && $nama_foto == null && $tmp_laporan == null && $type_laporan == null && $nama_laporan == null){
		$sql = "UPDATE laporan SET 
			id_keg='$id_keg',
			tgl_lap=CURDATE(),
			status_lap='Draft' 
			WHERE id_lap=$id_lap";
	}else if($tmp_foto == null && $type_foto == null && $nama_foto == null){
		$sql = "UPDATE laporan SET 
			id_keg='$id_keg',
			judul_lap='$nama_laporan',
			tgl_lap=CURDATE(),
			status_lap='Draft'
			WHERE id_lap=$id_lap";
	}else if($tmp_laporan == null && $type_laporan == null && $nama_laporan == null){
		$sql = "UPDATE laporan SET 
			id_keg='$id_keg',
			tgl_lap=CURDATE(),
			status_lap='Draft',
			foto='$nama_foto' 
			WHERE id_lap=$id_lap";
	}else{
		$sql = "UPDATE laporan SET 
			id_keg='$id_keg',
			judul_lap='$nama_laporan',
			tgl_lap=CURDATE(),
			status_lap='Draft',
			foto='$nama_foto' 
			WHERE id_lap=$id_lap";
	}
}
$stmt = $connect->prepare($sql);
$stmt->execute(); 

header('Location:../home.php?view=laporan');
?>