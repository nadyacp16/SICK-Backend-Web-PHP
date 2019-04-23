<?php
require 'db.php';
if(!isset($_SESSION)){ 
		session_start();
}

if(isset($_SESSION["loggedin"]) === false){
  header("location: index.php");
  exit;
}
?>
<?php 
require_once('db.php');
if(isset($_GET['del'])){
  $del = $_GET['del'];
  $con->query("DELETE FROM user WHERE nomoridentitas = $del");
}
else{
  $query = "SELECT * FROM user JOIN peran ON user.id_peran=peran.id_peran WHERE user.id_peran!=1 AND user.id_peran!=7 ORDER BY nomoridentitas ASC";
}

if(isset($_POST['submit'])){
  $id = mysqli_real_escape_string($con,$_POST['nomoridentitas']);
  $password = mysqli_real_escape_string($con,$_POST['password']);
  $nama = mysqli_real_escape_string($con,$_POST['nama']);
  $peran = mysqli_real_escape_string($con,$_POST['id_peran']);

  $q = "SELECT * FROM user WHERE user.id_peran!=1 AND user.id_peran!=7 ORDER BY nomoridentitas DESC LIMIT 1";
  $r = mysqli_query($con, $q);

  if(empty($nama) || empty($id) || empty($password) || empty($peran)){
      $error = "All Feilds Required, Try Again";

  }
  else{
      $hash=password_hash($password,PASSWORD_BCRYPT,array('cost'=>12));
      var_dump($hash);
      
      $con->query("INSERT INTO `user` (`nomoridentitas`, `nama`, `password`, `id_peran`) VALUES ('$id', '$nama', '$hash', '$peran')");
      $error = "Tambah Data Selesai";
      $color = "green";
      header("Location:all-tpkp.php");
      ob_flush();
  }
}
?>