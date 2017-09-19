<?php
require_once 'sesi.php';
require_once 'koneksi.php';

if (isset($_REQUEST['id_keg'])) {
	$id_keg = $_REQUEST['id_keg'];
} else {
	$id_keg = 0;
}

$dana_keg = $_REQUEST['dana_keg'];
$id_user = $_REQUEST['id_user'];
$nama_keg = $_REQUEST['nama_keg'];
$tgl_keg = $_REQUEST['tgl_keg'];
$tgl2_keg = $_REQUEST['tgl2_keg'];
$tmp_keg = $_REQUEST['tmp_keg'];
$plk_keg = $_REQUEST['plk_keg'];
$status_keg = "Draft";

if ($id_keg == 0) {
	$plk = array();

	for($i=0;$i<$plk_keg;$i++){
		$plk[$i][0]=$_REQUEST['nama'.$i];
		$plk[$i][1]=$_REQUEST['nip'.$i];
		$plk[$i][2]=$_REQUEST['pangkat'.$i];
		$plk[$i][3]=$_REQUEST['jabatan'.$i];
		$plk[$i][4]=$_REQUEST['unit'.$i];
	}

	$sql = "INSERT INTO kegiatan (dana_keg, id_user, nama_keg, tgl_keg, tgl2_keg, tmp_keg, plk_keg, status_keg) 
			VALUES ('$dana_keg', '$id_user', '$nama_keg', '$tgl_keg','$tgl2_keg', '$tmp_keg', '$plk_keg', '$status_keg')";

	$stmt = $connect->prepare($sql);
	$stmt->execute();	

	$keg = $connect->lastInsertId();

	foreach($plk as $row) {
		$sql2 = "INSERT INTO pelaksana (id_keg, nama_plk, nip_plk, pangkat_plk, jabatan_plk, unit_plk) 
			VALUES ('$keg','" . implode("', '", $row) . "')";
		$stmt2 = $connect->prepare($sql2);
		$stmt2->execute();	
	}

} else {

	$plk2_keg = $_REQUEST['plk2_keg'];
	$plk3_keg = $plk2_keg+$plk_keg;
	$plk = array();

	for($i=0;$i<$plk3_keg;$i++){
		$plk[$i][0]=@$_REQUEST['id'.$i];
		$plk[$i][1]=$id_keg;
		$plk[$i][2]=$_REQUEST['nama'.$i];
		$plk[$i][3]=$_REQUEST['nip'.$i];
		$plk[$i][4]=$_REQUEST['pangkat'.$i];
		$plk[$i][5]=$_REQUEST['jabatan'.$i];
		$plk[$i][6]=$_REQUEST['unit'.$i];
	}

	$sql = "UPDATE kegiatan SET 
		dana_keg='$dana_keg',
		id_user='$id_user',
		nama_keg='$nama_keg',
		tgl_keg='$tgl_keg',
		tgl2_keg='$tgl2_keg',  
		tmp_keg='$tmp_keg',
		plk_keg='$plk_keg', 
		status_keg='Draft' 
		WHERE id_keg=$id_keg";

	$stmt = $connect->prepare($sql);
	$stmt->execute();

	foreach ($plk as $key){

		if($key[0]!=null){
			$sql2 = "UPDATE pelaksana SET 
	        id_keg ='$key[1]',
	        nama_plk ='$key[2]',
	        nip_plk ='$key[3]',
	        pangkat_plk ='$key[4]',
	        jabatan_plk ='$key[5]',
	        unit_plk ='$key[6]'
	        WHERE id_plk = '{$key[0]}'";
			$stmt2 = $connect->prepare($sql2);
			$stmt2->execute();
		}else{
			$sql2 = "INSERT INTO pelaksana (id_keg, nama_plk, nip_plk, pangkat_plk, jabatan_plk, unit_plk) 
				VALUES ('$key[1]','$key[2]','$key[3]','$key[4]','$key[5]','$key[6]')";
			$stmt2 = $connect->prepare($sql2);
			$stmt2->execute();	
		}
	}
}

header('Location:../home.php?view=kegiatan');
?>