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
  $con->query("DELETE FROM peran WHERE id_peran = $del");
}
else{
  $query = "SELECT * FROM peran ORDER BY id_peran ASC";
}


if(isset($_POST['submit'])){
  $nama = mysqli_real_escape_string($con,$_POST['namaperan']);

  $q = "SELECT * FROM peran ORDER BY id_peran DESC LIMIT 1";
  $r = mysqli_query($con, $q);
  if(mysqli_num_rows($r) > 0){
      $row = mysqli_fetch_array($r);
      $id = $row['id_peran'];
      $id = $id + 1;
  }
  else{
      $id = 1;
  }


  if(empty($nama)){
      $error = "All Feilds Required, Try Again";

  }
  else{
      $insert_query = "INSERT INTO `peran` (`id_peran`, `nama_peran`) VALUES ('$id', '$nama')";
      if(mysqli_query($con, $insert_query)){
          $error = "Tambah Data Selesai";
          $color = "green";
          header("Location:all-peran.php");
          //echo "<script> document.location.href='http://localhost/backendweb/all-peran.php'; </script>";     
          ob_flush();
      }
      else{
          $error = "Error occured";
      }
  }
}

?>