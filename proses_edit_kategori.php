<?php 
require 'db.php';
if (isset($_POST) && $_POST != array()) {
	$sql = "SELECT * FROM kategori_layanan WHERE id_kategori = '".$_POST["editid_kategori"]."'";  
    $query = mysqli_query($con, $sql);  
    $result = mysqli_fetch_array($query);  
    echo json_encode($result);
}
?>