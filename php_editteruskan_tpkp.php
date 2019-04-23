<?php 
require 'db.php';
if (isset($_POST) && $_POST != array()) {
	$sql = "SELECT * FROM keluhan kel LEFT JOIN tpkp ON kel.id_tpkpfk = tpkp.nomoridentitastpkp LEFT JOIN kategori_layanan ktg ON kel.id_kategori = ktg.id_kategori WHERE kel.kode_keluhan = '".$_POST["kode_keluhan"]."'";  
    $query = mysqli_query($con, $sql);  
    $result = mysqli_fetch_array($query);  
    echo json_encode($result);
}
?>