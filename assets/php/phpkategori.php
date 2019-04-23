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
  $con->query("DELETE FROM kategori_layanan WHERE id_kategori = $del");
}
else{
  $query = "SELECT * FROM kategori_layanan ORDER BY id_kategori ASC";
}
if(isset($_POST['submit'])){
  $nama = mysqli_real_escape_string($con,$_POST['namakategori']);

  $q = "SELECT * FROM kategori_layanan ORDER BY id_kategori DESC LIMIT 1";
  $r = mysqli_query($con, $q);
  if(mysqli_num_rows($r) > 0){
      $row = mysqli_fetch_array($r);
      $id = $row['id_kategori'];
      $id = $id + 1;
  }
  else{
      $id = 1;
  }

  if(empty($nama)){
      $error = "All Feilds Required, Try Again";

  }
  else{
      $insert_query = "INSERT INTO `kategori_layanan` (`id_kategori`, `nama_kategori`) VALUES ('$id', '$nama')";
      if(mysqli_query($con, $insert_query)){
          $error = "Tambah Data Selesai";
          $color = "green";
          header("Location:all-kategorilayanan.php");
          //echo "<script> document.location.href='http://localhost/backendweb/all-peran.php'; </script>";     
          ob_flush();
      }
      else{
          $error = "Error occured";
      }
  }
}
?>