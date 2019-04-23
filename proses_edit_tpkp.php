<?php 
require 'db.php';
if (isset($_POST) && $_POST != array()) {
	$sql = "SELECT * FROM user WHERE nomoridentitas = '".$_POST["nomoridentitas"]."'";  
    $query = mysqli_query($con, $sql);  
    $result = mysqli_fetch_array($query);  
    echo json_encode($result);
}
?>