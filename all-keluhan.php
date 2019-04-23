<?php include 'header-admin.php'?>;

<?php
require 'assets/php/phpkeluhan.php';
?>


<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/form.css" />
</head>

<body>
  <div class="hor">
    <div class="block"><h1 class="txtJudul">Data Keluhan</h1></div>
  </div>
  <input type="text" id="myInput" onkeyup="myFunctionSearchKeluhan()" placeholder="Cari" title="Type in a name">
  <select style="width:auto;" onchange="myFunctionSearchByKategoriadmin()" id="searchbykategori" class="form-control">
    <option value="" disabled selected>Cari Kategori</option>
    <option value="" >Semua</option>
    <option value="Sangat Mendesak">Sangat Mendesak</option>
    <option value="Mendesak">Mendesak</option>
    <option value="Kurang Mendesak">Kurang Mendesak</option>
  </select>
  <select style="width:auto;" name="searchbystatus" onchange="myFunctionSearchByStatusadmin()" id="searchbystatus" class="form-control">
    <option value="" disabled selected>Cari Status</option>
    <option value="" >Semua</option>
    <option value="Diteruskan">Diteruskan</option>
    <option value="Dikerjakan">Dikerjakan</option>
    <option value="Selesai">Selesai</option>
  </select>
  <div style="overflow-x:auto;">
    <table id=myTable>
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
        <th>Hapus  </th>
      </tr>
    </tr>
    <?php
    $query  = "SELECT kel.kode_keluhan, kel.userfk, DATE_FORMAT(kel.tanggal_pengaduan, '%d-%m-%Y') AS tanggal_pengaduan, ktg.nama_kategori, kel.isi_keluhan, kel.image, user.nama, kel.status, kel.feedback, kel.keterangan_keluhan, kel.komentar_keluhan, DATE_FORMAT(kel.last_update, '%d-%m-%Y') AS last_update FROM keluhan kel LEFT JOIN user ON kel.id_tpkpfk = user.nomoridentitas LEFT JOIN kategori_layanan ktg ON kel.id_kategori = ktg.id_kategori ORDER BY kel.tanggal_pengaduan DESC";
    $result = mysqli_query($con, $query);
    $i = 0;

    if(!$result){
      die ("Query Error: ".mysqli_errno($con).
        " - ".mysqli_error($con));
    }

    while($data = mysqli_fetch_assoc($result))
    {
      $i++;
      echo "<tr>";
      echo "<td><center>$i</td>";
      echo "<td><center>$data[tanggal_pengaduan]</td>";
      echo "<td><center>$data[userfk]</td>";
      echo "<td><center>$data[nama_kategori]</td>";
      echo "<td><center>$data[isi_keluhan]</td>";
      echo "<td><center>$data[nama]</td>";
      echo "<td><center>$data[keterangan_keluhan]</td>";
      echo "<td><center>$data[status]</td>";
      echo "<td><center>$data[komentar_keluhan]</td>";
      echo "<td><center>$data[feedback]</td>";
      echo "<td><center>$data[last_update]</td>";

      ?>
      
      <td>
        <button class="plusbtn btn-edit-user" data-id="<?php echo $data['kode_keluhan'] ?>" style="width:auto;"><i class="fa fa-arrow-right"></i></button>
          <div id="id02" class="modal">
          <form class="modal-content" action="proses_teruskan_tpkp.php" method="POST" style="text-align: left;">
              <input type="hidden" name="idkeluhan" required>
                <div class="container">
                <h1 class="txtjud">Proses Keluhan</h1>
                <label for="editidtpkp"><b>Nama TPKP</b></label>
                <br>
                <select name="editidtpkp" id="idtpkp" class="form-control">
                <?php
                $sql = "SELECT * FROM user WHERE id_peran!=1 AND id_peran!=7 ORDER BY user.nomoridentitas";

                foreach ($con->query($sql) as $row) {
                
                  echo "<option value=$row[nomoridentitas] selected>$row[nama]</option>";
                }
                ?>
                </select>
                <br>
                <br>
                <label for="nama"><b>Kategori</b></label>
                <br>
                <select name="kategorikeluhan">
                  <option value="Sangat Mendesak">Sangat Mendesak</option>
                  <option value="Mendesak">Mendesak</option>
                  <option value="Kurang Mendesak">Kurang Mendesak</option>
                </select>
                <br>
                <br>
                <label for="komentar"><b>Komentar</b></label>
                <input type="text" name="komentar">
                <br>
                <br>
                <div class="clearfix">
                <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Batal</button>
                <button class="addbtn" type="submit">Teruskan</button>
                </div>
              </div>
          </form>
          </div>
        </td>
        <td>
          <a class="delbtn" href="all-keluhan.php?del=<?php echo $data['kode_keluhan']; ?>"><i class="fa fa-trash"></i></a>
        </td>
      <?php
      echo "</tr>";
    }
    mysqli_free_result($result);

    mysqli_close($con);

    ?>
  </table>
</div>


<script src="assets/js/modal.js"></script>
<script src="assets/js/search.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript">
    $(".btn-edit-user").click(function(e) {

      e.preventDefault();
      var id = $(this).attr('data-id');
      var modal = $("#id02");
      modal.css({'display':'block'});

      var post = {'kode_keluhan' : id};
      var target = 'php_editteruskan_tpkp.php';
      $.post(target,post, function(data) {
        var arr = JSON.parse(data);

        modal.find('select[name="editidtpkp"]').val(arr['id_tpkpfk']);
        modal.find('input[name="idkeluhan"]').val(arr['kode_keluhan']);

        modal.find('select[name="kategorikeluhan"]').val(arr['keterangan_keluhan']);
        modal.find('input[name="komentar"]').val(arr['komentar_keluhan']);
      });
    });
  </script>
</body>