<?php
require_once('db.php');
session_start();
extract($_POST);

if(isset($_SESSION["loggedin"]) === true){
  header("location: dasbor.php");
  exit;
}

if(isset($submit)){
  $usernameLogin = mysqli_real_escape_string($con,$_POST['nomoridentitas']);
  $passwordLogin = mysqli_real_escape_string($con,$_POST['password']);

  $sql_getpass="SELECT password from user where nomoridentitas='$usernameLogin'";
	$my_res=mysqli_query($con,$sql_getpass);
  $my_row=mysqli_fetch_row($my_res);
    
	if(password_verify($passwordLogin,$my_row[0])){
  $query = "select * from user where nomoridentitas='$usernameLogin'";
  $result = mysqli_query($con, $query);
  if(mysqli_num_rows($result)){
    $role = mysqli_fetch_assoc($result);
    $tipe=mysqli_fetch_row($result);
    $_SESSION['kosong']=$tipe[0];
    $_SESSION["loggedin"] = true;
    $_SESSION["user"] = $usernameLogin;
    $_SESSION["pass"] = $passwordLogin;
    

    if($role["id_peran"]!=1 && $role["id_peran"]!=7){
      $_SESSION["role"] = "tpkp";
      header("Location:dasbortpkp.php");
    }
    if($role["id_peran"]==1 && $role["id_peran"]!=7){
      $_SESSION["role"] = "admin";
      header("Location:dasbor.php");
    }
    else{
      $error="<div class='alert'><span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span> 
      Wrong username or password ! </div>";
      echo $error;
    }
  }
}
  else{
    $error="<div class='alert'><span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span> 
    Wrong username or password ! </div>";
    echo $error;
  }
}
?>
