<?php include 'header-admin.php'?>;

<?php
require 'assets/php/phpperan.php';
?>


<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/form.css" />
</head>

<body>
  <div class="hor">
    <div class="block"><h1 class="txtJudul">Data Peran</h1></div>
    <div class="block"><button class="plusbtn" onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><i class="fa fa-plus"></i></button></div>
  </div>
  <input type="text" id="myInput" onkeyup="myFunctionSearch()" placeholder="Cari" title="Type in a name">
  <div id="id01" class="modal">
    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    <form class="modal-content" action="" role="form" method="post">
      <div class="container">
        <h1>Tambah Peran</h1>
        <hr>
        <label for="namaperan"><b>Nama Peran</b></label>
        <input type="text" placeholder="Masukkan nama peran" name="namaperan" required>
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
      <th>Nama Peran</th>
      <th>Edit</th>
      <th>Hapus</th>
    </tr>

  <tbody>
    <?php
    $query = "SELECT * FROM peran ORDER BY id_peran ASC";
    $result = mysqli_query($con, $query);

    if(!$result){
      die ("Query Error: ".mysqli_errno($con).
        " - ".mysqli_error($con));
    }


    while($data = mysqli_fetch_assoc($result))
    {
      echo "<tr>";
      echo "<td><center>$data[id_peran]</td>";
      echo "<td><center>$data[nama_peran]</td>";

      ?>

      <td>
        <button class="plusbtn  btn-edit-peran" data-id="<?php echo $data['id_peran'] ?>" style="width:auto;"><i class="fa fa-edit"></i></button>
        <div id="id02" class="modal">
          <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
          <form class="modal-content" action="proses_update_peran.php" method="POST"  style="text-align: left;">
            <input type="hidden" name="id_peran" value="">
            <div class="container">
              <h1 class="txtjud">Edit Peran</h1>
              <hr>
              <label for="edit"><b>Nama Peran</b></label>
              <input type="text" name="nama_peran"  required>
              <div class="clearfix">
                <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Batal</button>
                <button class="addbtn" type="submit">Edit</button>
              </div>
            </div>
          </form>
        </div>
      </td>
      <td>
        <a class="delbtn" href="all-peran.php?del=<?php echo $data['id_peran']; ?>"><i class="fa fa-trash"></i></a>
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
 
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="assets/js/modal.js"></script>
  <script src="assets/js/search.js"></script>

  <script type="text/javascript">
    $(".btn-edit-peran").click(function(e) {

      e.preventDefault();
      var id = $(this).attr('data-id');
      var modal = $("#id02");
      modal.css({'display':'block'});

      var post = {'id_peran' : id};
      var target = 'proses_edit_peran.php';
      $.post(target,post, function(data) {
        var arr = JSON.parse(data);

        modal.find('input[name="id_peran"]').val(arr['id_peran']);
        modal.find('input[name="nama_peran"]').val(arr['nama_peran']);

      });
    });
  </script>

</body>