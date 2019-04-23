<?php  
require 'db.php';

if (isset($_POST) && $_POST != array()) {
    $con->query("UPDATE keluhan SET status = '".$_POST['editstatuskeluhan']."', komentar_keluhan = '".$_POST['komentartpkp']."', last_update=CURRENT_TIMESTAMP WHERE kode_keluhan = '".$_POST['idkeluhan']."'");
    //$con->query("UPDATE detail_keluhan SET id_tpkp = '".$_POST['editidtpkp']."', status='Diteruskan', tanggal_progress = NOW() WHERE id_keluhanfk = '".$_POST['idkeluhan']."'");  
    // $query = mysqli_query($connect, $sql);
    header("location:".$_SERVER['HTTP_REFERER']);
}
?>