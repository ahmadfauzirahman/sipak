<?php
session_name('sipak');
session_start();

require_once 'koneksi.php';

$username=$_REQUEST['username'];
$password=$_REQUEST['password'];

$sql = "SELECT * FROM user WHERE BINARY username='$username' AND password=md5('$password')";
$stmt = $connect->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();

$x = $stmt->fetch();

if($x){
	$_SESSION['username'] = $x->username;
	$_SESSION['nama'] = $x->nama;
	$_SESSION['level'] = $x->level;
	$_SESSION['id_user'] = $x->id_user;
	header("Location:../home.php");
}else{
	$_SESSION['username'] = '';
?>	<script>
	alert('Maaf, Username atau Password Salah!');
	window.location.href='../index.php';
	</script>
<?php
}
?>