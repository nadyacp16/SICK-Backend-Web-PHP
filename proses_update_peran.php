<?php  
if (isset($_POST) && $_POST != array()) {
	$connect = mysqli_connect("localhost", "root", "", "db_atma");  
	$sql = "UPDATE peran SET nama_peran = '".$_POST['nama_peran']."' WHERE id_peran = '".$_POST["id_peran"]."'";  
    $query = mysqli_query($connect, $sql);
    header("location:".$_SERVER['HTTP_REFERER']);
}
?>