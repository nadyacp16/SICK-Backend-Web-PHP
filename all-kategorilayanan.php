<?php include 'header-admin.php'?>;

<?php
require 'assets/php/phpkategori.php';
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/form.css" />
</head>

<body>
  <div class="hor">
    <div class="block"><h1 class="txtJudul">Data Kategori Layanan</h1></div>
    <div class="block"><button class="plusbtn" onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><i class="fa fa-plus"></i></button></div>
  </div>
  <input type="text" id="myInput" onkeyup="myFunctionSearch()" placeholder="Cari" title="Type in a name">
  <div id="id01" class="modal">
    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    <form class="modal-content" action="" method="post">
      <div class="container">
        <h1>Tambah Kategori Layanan</h1>
        <hr>
        <label for="namakategori"><b>Nama Kategori Layanan</b></label>
        <input type="text" placeholder="Masukkan nama kategori layanan" name="namakategori" required>
        <div class="clearfix">
          <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Batal</button>
          <button class="addbtn" name="submit" type="submit">Tambah</button>
        </div>
      </div>
    </form>
  </div>



  <!-- ********************************************TABEL************************************************** -->
  <div style="overflow-x:auto;">
    <table id=myTable>
      <tr>
        <th>No</th>
        <th>Nama Kategori Layanan</th>
        <th>Edit</th>
        <th>Hapus</th>
      </tr>
      
      <tr>
        <?php

        $query = "SELECT * FROM kategori_layanan ORDER BY id_kategori ASC";
        $result = mysqli_query($con, $query);

        if(!$result){
          die ("Query Error: ".mysqli_errno($con).
            " - ".mysqli_error($con));
        }


        while($data = mysqli_fetch_assoc($result))
        {
          echo "<tr>";
          echo "<td><center>$data[id_kategori]</td>";
          echo "<td><center>$data[nama_kategori]</td>";

          ?>

          <td>
          <button class="plusbtn  btn-edit-kategori" data-id="<?php echo $data['id_kategori'] ?>" style="width:auto;"><i class="fa fa-edit"></i></button>
          <div id="id02" class="modal">
              <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
              <form class="modal-content" action="proses_update_kategori.php" method="POST" style="text-align: left;">
              <input type="hidden" name="editid_kategori" value="">
                <div class="container">
                  <h1 class="txtjud">Edit Kategori Layanan</h1>
                  <hr>
                  <label for="editnamakategori"><b>Nama Kategori Layanan</b></label>
                  <input type="text" name="editnama_kategori" required>
                  <div class="clearfix">
                  <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Batal</button>
                  <button class="addbtn" type="submit">Edit</button>
                  </div>
                </div>
              </form>
            </div>
          </td>
          <td>
            <a class="delbtn" href="all-kategorilayanan.php?del=<?php echo $data['id_kategori']; ?>"><i class="fa fa-trash"></i></a>
          </td>
          <?php
          echo "</td>";
          echo "</tr>";
        }
        mysqli_free_result($result);

        mysqli_close($con);

        ?>
      </tr>
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

      var post = {'editid_kategori' : id};
      var target = 'proses_edit_kategori.php';
      $.post(target,post, function(data) {
        var arr = JSON.parse(data);

        modal.find('input[name="editid_kategori"]').val(arr['id_kategori']);
        modal.find('input[name="editnama_kategori"]').val(arr['nama_kategori']);

      });
    });
  </script>
</body>