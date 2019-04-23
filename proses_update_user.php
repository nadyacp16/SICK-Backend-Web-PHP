<?php  
require 'db.php';

if (isset($_POST) && $_POST != array()) {
    $hash=password_hash( $_POST['editpassword'],PASSWORD_BCRYPT,array('cost'=>12));
	$con->query("UPDATE user SET nama = '".$_POST['editnama']."', id_peran = '".$_POST['editid_peran']."' WHERE nomoridentitas = '".$_POST["editnomoridentitas"]."'");
	header("location:".$_SERVER['HTTP_REFERER']);
}
?>