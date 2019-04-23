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
  $q = "DELETE FROM keluhan WHERE nomoridentitas = $del";
  $run = mysqli_query($con, $q);
}
else{
  $query = "SELECT kel.kode_keluhan, DATE_FORMAT(kel.tanggal_pengaduan, '%d-%m-%Y') AS tanggal_pengaduan, ktg.nama_kategori, kel.isi_keluhan, kel.image, user.nama, kel.status, kel.feedback, kel.keterangan_keluhan, kel.komentar_keluhan, DATE_FORMAT(kel.last_update, '%d-%m-%Y') AS last_update FROM keluhan kel LEFT JOIN user ON kel.id_tpkpfk = user.nomoridentitas LEFT JOIN kategori_layanan ktg ON kel.id_kategori = ktg.id_kategori WHERE kel.id_kategori='KTG03' AND id_tpkpfk IS NOT NULL ORDER BY kel.tanggal_pengaduan DESC";
}
?>