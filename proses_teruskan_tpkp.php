<?php  
require 'db.php';

if (isset($_POST) && $_POST != array()) {
    $con->query("UPDATE keluhan SET id_tpkpfk = '".$_POST['editidtpkp']."', keterangan_keluhan = '".$_POST['kategorikeluhan']."', komentar_keluhan = '".$_POST['komentar']."', status='Diteruskan', last_update=CURRENT_TIMESTAMP WHERE kode_keluhan = '".$_POST['idkeluhan']."'");  
    // $query = mysqli_query($connect, $sql);
    header("location:".$_SERVER['HTTP_REFERER']);
}
?>