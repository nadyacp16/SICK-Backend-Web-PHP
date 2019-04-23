<?php include 'header-tpkp.php'?>;

<?php
require 'assets/php/phpkeluhanberkasujian.php';
?>


<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/form.css" />
</head>

<body>
  <div class="hor">
    <div class="block"><h1 class="txtJudul">Data Keluhan Berkas Ujian</h1></div>
  </div>
  <input type="text" id="myInput" onkeyup="myFunctionSearch()" placeholder="Cari" title="Type in a name">
  <select style="width:auto;" onchange="myFunctionSearchByKategori()" id="searchbykategori" class="form-control">
    <option value="" disabled selected>Cari Kategori</option>
    <option value="" >Semua</option>
    <option value="Sangat Mendesak">Sangat Mendesak</option>
    <option value="Mendesak">Mendesak</option>
    <option value="Kurang Mendesak">Kurang Mendesak</option>
  </select>
  <select style="width:auto;" name="searchbystatus" onchange="myFunctionSearchByStatus()" id="searchbystatus" class="form-control">
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
    </tr>
    <?php

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
          <button class="plusbtn  btn-edit-kategori" data-id="<?php echo $data['kode_keluhan'] ?>" style="width:auto;"><i class="fa fa-arrow-right"></i></button>
          <div id="id02" class="modal">
              <form class="modal-content" action="proses_pengerjaan_keluhan.php" method="POST" style="text-align: left;">
              <input type="hidden" name="idkeluhan" value="">
              <input type="hidden" name="iduser" value="">
              <input type="hidden" name="idtpkp" value="">
                <div class="container">
                  <h1 class="txtjud">Proses Keluhan</h1>
                  <hr>
                  <label for="editstatuskeluhan"><b>Status</b></label>
                  <br>
                  <select name="editstatuskeluhan" id="editstatuskeluhan1" class="form-control">
                    <option value="Dikerjakan" selected>Dikerjakan</option>
                    <option value="Selesai" selected>Selesai</option>
                  </select>
                  <br>
                  <br>
                  <label for="komentartpkp"><b>Komentar</b></label>
                  <input type="text" name="komentartpkp">
                  <br>
                  <br>
                <div class="clearfix">
                  <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Batal</button>
                  <button class="addbtn" type="submit">Proses</button>
                  </div>
                </div>
              </form>
            </div>
          </td>
      <?php
      echo "</td>";
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
    $(".btn-edit-kategori").click(function(e) {

      e.preventDefault();
      var id = $(this).attr('data-id');
      var modal = $("#id02");
      modal.css({'display':'block'});

      var post = {'kode_keluhan' : id};
      var target = 'php_editteruskan_tpkp.php';
      $.post(target,post, function(data) {
        var arr = JSON.parse(data);

        modal.find('select[name="editstatuskeluhan"]').val(arr['status']);
        modal.find('input[name="iduser"]').val(arr['id_user']);
        modal.find('input[name="idtpkp"]').val(arr['id_tpkp']);        
        modal.find('input[name="idkeluhan"]').val(arr['kode_keluhan']);
        modal.find('input[name="komentartpkp"]').val(arr['komentar_keluhan']);

      });
    });
  </script>
</body>