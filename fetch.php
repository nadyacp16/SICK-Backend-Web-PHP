<?php

//fetch.php

$connect = new PDO("mysql:host=localhost;dbname=db_atma", "root", "");

if($_POST["query"] != '')
{
 $search_array = explode(",", $_POST["query"]);
 $search_text = "'" . implode("', '", $search_array) . "'";
 $query = "SELECT kel.kode_keluhan, kel.userfk, DATE_FORMAT(kel.tanggal_pengaduan, '%d-%m-%Y') AS tanggal_pengaduan, ktg.nama_kategori, kel.isi_keluhan, kel.image, tpkp.namatpkp, kel.status, kel.feedback, kel.keterangan_keluhan, kel.komentar_keluhan, DATE_FORMAT(kel.last_update, '%d-%m-%Y') AS last_update FROM keluhan kel LEFT JOIN tpkp ON kel.id_tpkpfk = tpkp.nomoridentitastpkp LEFT JOIN kategori_layanan ktg ON kel.id_kategori = ktg.id_kategori WHERE kel.keterangan_keluhan IN (".$search_text.") ORDER BY kel.tanggal_pengaduan DESC";
}
else
{
 $query = "SELECT kel.kode_keluhan, kel.userfk, DATE_FORMAT(kel.tanggal_pengaduan, '%d-%m-%Y') AS tanggal_pengaduan, ktg.nama_kategori, kel.isi_keluhan, kel.image, tpkp.namatpkp, kel.status, kel.feedback, kel.keterangan_keluhan, kel.komentar_keluhan, DATE_FORMAT(kel.last_update, '%d-%m-%Y') AS last_update FROM keluhan kel LEFT JOIN tpkp ON kel.id_tpkpfk = tpkp.nomoridentitastpkp LEFT JOIN kategori_layanan ktg ON kel.id_kategori = ktg.id_kategori ORDER BY kel.tanggal_pengaduan DESC";
}

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();
$output = '';

if($total_row > 0)
{
 foreach($result as $row)
 {
     $i=1;
     $output .= '
  <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Pengirim</th>
        <th>Tujuan</th>
        <th>Isi</th>
        <th>TPKP</th>
        <th>Kategori</th>
        <th>Status</th>
        <th>Komentar</th>
        <th>Feedback</th>
        <th>Last Update</th>
        <th>Proses</th>
    </tr>
   <tr>
   
   <td>'.$i++.'</td>
   <td>'.$row["tanggal_pengaduan"].'</td>
   <td>'.$row["userfk"].'</td>
   <td>'.$row["nama_kategori"].'</td>
   <td>'.$row["isi_keluhan"].'</td>
   <td>'.$row["namatpkp"].'</td>
   <td>'.$row["keterangan_keluhan"].'</td>
   <td>'.$row["status"].'</td>
   <td>'.$row["komentar_keluhan"].'</td>
   <td>'.$row["feedback"].'</td>
   <td>'.$row["last_update"].'</td>
  </tr>
  ';
 }
}
else
{
 $output .= '
 <tr>
  <td colspan="5" align="center">No Data Found</td>
 </tr>
 ';
}
echo $output;
?>