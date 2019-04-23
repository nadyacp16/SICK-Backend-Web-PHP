<?php  
require 'db.php';

if (isset($_POST) && $_POST != array()) {
	$sql = "SELECT * FROM peran WHERE id_peran = '".$_POST["id_peran"]."'";  
    $query = mysqli_query($con, $sql);  
    $result = mysqli_fetch_array($query);  
    echo json_encode($result);
}
?>