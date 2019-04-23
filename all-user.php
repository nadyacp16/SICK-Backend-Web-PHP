<?php include 'header-admin.php'?>;

<?php
require 'assets/php/phpuser.php';
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/form.css" />
</head>

<body>
  <div class="hor">
    <div class="block"><h1 class="txtJudul">Data Pengguna</h1></div>
    <div class="block"><button class="plusbtn" onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><i class="fa fa-plus"></i></button></div>
  </div>
  <input type="text" id="myInput" onkeyup="myFunctionSearch()" placeholder="Cari" title="Type in a name">
  <!-- <select name="filter_gender" id="filter_gender" class="form-control" required>
    <option value="">Select Gender</option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
  </select> -->
  <div id="id01" class="modal">
    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    <form class="modal-content" action="" role="form" method="post" >
      <div class="container">
        <h1>Tambah Pengguna</h1>
        <hr>
        <label for="nomoridentitas"><b>Nomor Identitas</b></label>
        <input type="text" placeholder="Masukkan nomor identitas" id="nomoridentitas1" name="nomoridentitas" required>
        <br>
        <br>
        <label for="nama"><b>Nama</b></label>
        <input type="text" placeholder="Masukkan nama" id="nama1" name="nama" required>
        <br>
        <br>
        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Masukkan password" id="password1" name="password" required>
        <br>
        <br>
        <label for="peran"><b>Peran</b></label>
        <br>
        <select class="form-control" name="id_peran">
        <option value="">Pilih Peran</option>
        <?php
        $ambil = $con->query("SELECT * FROM peran");?>

        <?php
        while(
          $peran = $ambil->fetch_assoc()
        ){
        ?>

        <option value="<?php echo $peran['id_peran'];?>"><?php echo $peran['nama_peran'];?></option>
        <?php } ?>
        </select>
        <br>
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
        <th>Nomor Identitas</th>
        <th>Nama</th>
        <th>Peran</th>
        <th>Edit</th>
        <th>Hapus</th>
      </tr>
      
      <tbody>
      <?php

      $query = "SELECT * FROM user JOIN peran ON user.id_peran=peran.id_peran ORDER BY nomoridentitas ASC";
      $result = mysqli_query($con, $query);

      if(!$result){
        die ("Query Error: ".mysqli_errno($con).
          " - ".mysqli_error($con));
      }


      while($data = mysqli_fetch_assoc($result))
      {
        echo "<tr>";
        echo "<td><center>$data[nomoridentitas]</td>";
        echo "<td><center>$data[nama]</td>";
        echo "<td><center>$data[nama_peran]</td>";

        ?>
        <td>
        <button class="plusbtn  btn-edit-user" data-id="<?php echo $data['nomoridentitas'] ?>" style="width:auto;"><i class="fa fa-edit"></i></button>
          <div id="id02" class="modal">
          <form class="modal-content" action="proses_update_user.php" method="POST" style="text-align: left;">
              <input type="hidden" name="id_user" value="">
                <div class="container">
                <h1 class="txtjud">Edit Pengguna</h1>
                <hr>
                <label for="nomoridentitas"><b>Nomor Identitas</b></label>
                <input type="text" name="editnomoridentitas" required>
                <br>
                <br>
                <label for="nama"><b>Nama</b></label>
                <input type="text" name="editnama" required>
                <br>
                <br>
                <label for="password"><b>Password</b></label>
                <input type="password" name="editpassword" disabled>
                <br>
                <br>
                <label for="peran"><b>Peran</b></label>
                <br>
                <select name="editid_peran" id="peran1" class="form-control">
                <?php
                $sql = "SELECT * FROM peran ORDER BY peran.id_peran";

                foreach ($con->query($sql) as $row) {
                
                  echo "<option value=$row[id_peran] selected>$row[nama_peran]</option>";
                }
                ?>
                </select>
                <br>
                <div class="clearfix">
                <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Batal</button>
                <button class="addbtn" type="submit">Edit</button>
                </div>
              </div>
            </form>
          </div>
        </td>
        <td>
          <a class="delbtn" href="all-user.php?del=<?php echo $data['nomoridentitas']; ?>"><i class="fa fa-trash"></i></a>
        </td>
        <?php
        echo "</td>";
        echo "</tr>";
      }
      mysqli_free_result($result);

      mysqli_close($con);

      ?>
      </tbody>
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

      var post = {'nomoridentitas' : id};
      var target = 'proses_edit_user.php';
      $.post(target,post, function(data) {
        var arr = JSON.parse(data);

        modal.find('input[name="editnomoridentitas"]').val(arr['nomoridentitas']);
        modal.find('input[name="editnama"]').val(arr['nama']);
        modal.find('input[name="editpassword"]').val(arr['password']);
        modal.find('select[name="editid_peran"]').val(arr['id_peran']);

      });
    });
  </script>
</body>