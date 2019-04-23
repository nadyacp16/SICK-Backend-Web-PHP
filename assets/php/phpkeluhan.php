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
  $q = "DELETE FROM keluhan WHERE kode_keluhan = $del";
  $run = mysqli_query($con, $q);
}
else if (isset($_GET["submit"])) {
  $name = htmlentities(strip_tags(trim($_GET["submit"])));  
  $name = mysqli_real_escape_string($con,$name);    
  $query  = "SELECT kel.kode_keluhan, kel.userfk, DATE_FORMAT(kel.tanggal_pengaduan, '%d-%m-%Y') AS tanggal_pengaduan, ktg.nama_kategori, kel.isi_keluhan, kel.image, tpkp.namatpkp, kel.status, kel.feedback, kel.keterangan_keluhan, kel.komentar_keluhan, DATE_FORMAT(kel.last_update, '%d-%m-%Y') AS last_update FROM keluhan kel LEFT JOIN tpkp ON kel.id_tpkpfk = tpkp.nomoridentitastpkp LEFT JOIN kategori_layanan ktg ON kel.id_kategori = ktg.id_kategori WHERE kel.keterangan_keluhan LIKE '%$name%' ORDER BY kel.tanggal_pengaduan DESC";     
}
else{
  $query = "SELECT kel.kode_keluhan, kel.userfk, DATE_FORMAT(kel.tanggal_pengaduan, '%d-%m-%Y') AS tanggal_pengaduan, ktg.nama_kategori, kel.isi_keluhan, kel.image, user.nama, kel.status, kel.feedback, kel.keterangan_keluhan, kel.komentar_keluhan, DATE_FORMAT(kel.last_update, '%d-%m-%Y') AS last_update FROM keluhan kel LEFT JOIN user ON kel.id_tpkpfk = user.nomoridentitas LEFT JOIN kategori_layanan ktg ON kel.id_kategori = ktg.id_kategori ORDER BY kel.tanggal_pengaduan DESC";
}
?>