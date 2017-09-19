<?php
require_once 'sesi.php';
require_once 'koneksi.php';

if (isset($_REQUEST['id_user'])) {
	$id_user = $_REQUEST['id_user'];
} else {
	$id_user = 0;
}

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$nama = $_REQUEST['nama'];
$email = $_REQUEST['email'];
$level = $_REQUEST['level'];

if ($id_user == 0) {
	$sql = "INSERT INTO user (username, password, nama, email, level) 
			VALUES ('$username', md5('$password'), '$nama', '$email', '$level')";
} else {
	$sql2 = "SELECT * FROM user WHERE id_user='$id_user'";
	$stmt2 = $connect->prepare($sql2);
	$stmt2->setFetchMode(PDO::FETCH_OBJ);
	$stmt2->execute();

	$y = $stmt2->fetch();
	
	if($password==$y->password){
		$sql = "UPDATE user SET 
			username='$username',
			nama='$nama',
			email='$email', 
			level='$level' 
			WHERE id_user=$id_user";
	}else{
		$sql = "UPDATE user SET 
			username='$username',
			password=md5('$password'),
			nama='$nama',
			email='$email', 
			level='$level' 
			WHERE id_user=$id_user";
	}
}
$stmt = $connect->prepare($sql);
$stmt->execute(); 

header('Location:../home.php?view=hak_akses');
?>