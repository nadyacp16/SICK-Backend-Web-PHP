<?php
  session_start();
  $username=$_SESSION["user"];
  $password=$_SESSION["pass"];
?>

<head>
  <title>SICK Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/header.css" />
  <link rel="stylesheet" href="assets/css/sidebar.css" />
  <link rel="shortcut icon" href="sicklogo.ico">
</head>

<body>
  <div class="header">
    <a href="" class="logo" style="margin-top: auto; margin-bottom: auto;"><img src="assets/img/sicklogo.png" class="logoresponsive">   SICK (Sistem Informasi Complaint Komunitas)</a>
    <div class="header-right">
      <a class="active" href="logout.php">Logout</a>
    </div>
  </div>

  <div class="sidebar">
    <a href="dasbortpkp.php"><i style="margin-right: 5px;" class="fa fa-dashboard"></i>Dasbor</a>
    <button class="dropdown-btn"><i style="margin-right: 5px;" class="fa fa-table"></i>Data
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
      <a href="all-keluhantpkp.php">Seluruh Keluhan</a>
      <a href="all-berkasujian.php">Berkas Ujian</a>
      <a href="all-saranaperkuliahan.php">Sarana Perkuliahan</a>
      <a href="all-saranaprasaranaumum.php">Sarana Prasarana Umum</a>
      <a href="all-suratmenyurat.php">Surat Menyurat</a>
      <a href="all-jadwalkppendadaran.php">Jadwal KP/Pendadaran</a>
    </div>
  </div>

  <script>
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }
  </script>
</body>