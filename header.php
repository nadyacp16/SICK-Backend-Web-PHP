<head>
  <title>askAtma Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/header.css" />
  <link rel="stylesheet" href="assets/css/sidebar.css" />
  <link rel="shortcut icon" href="sicklogo.ico">
</head>

<body>
  <div class="header">
    <a href="dasbor.php" class="logo">askAtma</a>
    <div class="header-right">
      <a class="active" href="login.php">Logout</a>
    </div>
  </div>

  <div class="sidebar">
    <a href="beranda.php"><i style="margin-right: 5px;" class="fa fa-dashboard"></i>Dasbor</a>
    <button class="dropdown-btn"><i style="margin-right: 5px;" class="fa fa-table"></i>Tabel
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
      <a href="all-keluhan.php">Keluhan</a>
      <a href="all-kategorilayanan.php">Kategori Layanan</a>
      <a href="all-user.php">Pengguna</a>
      <a href="all-tpkp.php">TPKP</a>
      <a href="all-peran.php">Peran</a>
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