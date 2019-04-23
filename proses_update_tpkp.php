<?php  
require 'db.php';

if (isset($_POST) && $_POST != array()) {
    $hash=password_hash( $_POST['editpasswordtpkp'],PASSWORD_BCRYPT,array('cost'=>12));
	$con->query("UPDATE user SET nama = '".$_POST['editnamatpkp']."', id_peran = '".$_POST['editid_perantpkp']."' WHERE nomoridentitas = '".$_POST["editnomoridentitastpkp"]."'");
	header("location:".$_SERVER['HTTP_REFERER']);
}
?>