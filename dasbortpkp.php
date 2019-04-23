<?php include 'header-tpkp.php'?>;
<?php
require 'db.php';
if(!isset($_SESSION)){ 
	session_start();
}
$query_sangatmendesak = $con->query("SELECT COUNT(kode_keluhan) FROM keluhan WHERE keterangan_keluhan='Sangat Mendesak'");
$row_sangatmendesak = mysqli_fetch_row($query_sangatmendesak);
$count_sangatmendesak = $row_sangatmendesak[0];

$query_mendesak = $con->query("SELECT COUNT(kode_keluhan) FROM keluhan WHERE keterangan_keluhan='Mendesak'");
$row_mendesak = mysqli_fetch_row($query_mendesak);
$count_mendesak = $row_mendesak[0];

$query_kurangmendesak = $con->query("SELECT COUNT(kode_keluhan) FROM keluhan WHERE keterangan_keluhan='Kurang Mendesak'");
$row_kurangmendesak = mysqli_fetch_row($query_kurangmendesak);
$count_kurangmendesak = $row_kurangmendesak[0];

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
	<div class="card-sangatmendesak">
		<h1 style="color: #2d3436; font-size: 28px;">Sangat Mendesak</h1>
		<p class="price"><?php echo $count_sangatmendesak?> Keluhan</p>
		<p><a href="all-keluhantpkp.php"><i class="fa fa-arrow-right"></i></a></p>
	</div>
	<br>
	<div class="card-mendesak">
		<h1 style="color: #2d3436; font-size: 28px;">Mendesak</h1>
		<p class="price"><?php echo $count_mendesak?> Keluhan</p>
		<p><a href="all-keluhantpkp.php"><i class="fa fa-arrow-right"></i></a></p>
	</div>
	<br>
	<div class="card-kurangmendesak">
		<h1 style="color: #2d3436; font-size: 28px;">Kurang Mendesak</h1>
		<p class="price"><?php echo $count_kurangmendesak?> Keluhan</p>
		<p><a href="all-keluhantpkp.php"><i class="fa fa-arrow-right"></i></a></p>
	</div>
	<br>
</div>
</body>