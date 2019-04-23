<?php include 'header-admin.php'?>;
<?php
require 'db.php';
if(!isset($_SESSION)){ 
		session_start();
}
$query = $con->query("SELECT COUNT(kode_keluhan) FROM keluhan");
$row = mysqli_fetch_row($query);
$count = $row[0];

$query_pengguna = $con->query("SELECT COUNT(nomoridentitas) FROM user");
$row_pengguna = mysqli_fetch_row($query_pengguna);
$count_pengguna = $row_pengguna[0];

$query_tpkp = $con->query("SELECT COUNT(nomoridentitastpkp) FROM tpkp");
$row_tpkp = mysqli_fetch_row($query_tpkp);
$count_tpkp = $row_tpkp[0];

$query_kategori = $con->query("SELECT COUNT(id_kategori) FROM kategori_layanan");
$row_kategori = mysqli_fetch_row($query_kategori);
$count_kategori = $row_kategori[0];

if(isset($_SESSION["loggedin"]) === false){
  header("location: index.php");
  exit;
}
?>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
<div class="dasbor">
	<div class="card">
		<h1 style="color: #2d3436; font-size: 28px;">Keluhan</h1>
		<p class="price"><?php echo $count?> Keluhan</p>
		<p><a href="all-keluhan.php"><i class="fa fa-arrow-right"></i></a></p>
	</div>
	<br>
	<div class="card-pengguna">
		<h1 style="color: #2d3436; font-size: 28px;">Pengguna</h1>
		<p class="price"><?php echo $count_pengguna?> Pengguna</p>
		<p><a href="all-user.php"><i class="fa fa-arrow-right"></i></a></p>
	</div>
	<br>
	<div class="card-tpkp">
		<h1 style="color: #2d3436; font-size: 28px;">TPKP</h1>
		<p class="price"><?php echo $count_tpkp?> TPKP</p>
		<p><a href="all-tpkp.php"><i class="fa fa-arrow-right"></i></a></p>
	</div>
	<br>
	<div class="card-kategori">
		<h1 style="color: #2d3436; font-size: 28px;">Kategori Layanan</h1>
		<p class="price"><?php echo $count_kategori?> Kategori Layanan</p>
		<p><a href="all-kategorilayanan.php"><i class="fa fa-arrow-right"></i></a></p>
	</div>
</div>
</body>