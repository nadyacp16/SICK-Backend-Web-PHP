<?php  
require 'db.php';

if (isset($_POST) && $_POST != array()) {
	$sql = "UPDATE kategori_layanan SET nama_kategori = '".$_POST['nama_kategori']."' WHERE id_kategori = '".$_POST["id_kategori"]."'";  
    $query = mysqli_query($connect, $sql);
    header("location:".$_SERVER['HTTP_REFERER']);
}
?>