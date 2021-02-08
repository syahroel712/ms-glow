<?php
session_start();
include "inc/koneksi.php";
$iden = mysql_fetch_array(mysql_query("SELECT * FROM tb_user where kode_user='$_SESSION[kasir]'"));
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/libs/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/libs/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Input Modal</title>
</head>

<body>
  <!-- Main Content -->
  <div class="container-fluid">
    <div class="row main-content bg-success text-center">
      <div class="col-md-4 text-center company__info">
        <span class="company__logo">
          <h2><img src="assets/img/logo.png" alt="logo"></h2>
        </span>
      </div>
      <div class="col-md-8 col-xs-12 col-sm-12 login_form">
        <div class="container-fluid">
          <div class="row">
            <h2 class="p-3">Silahkan inputkan modal pada form berikut</h2>
          </div>
          <div class="row">
            <form class="form-group" method="POST">
              <div class="row">
                <input type="text" class="form__input" name='a' id="a" value="<?php echo $iden['username']; ?>" placeholder="Username">
              </div>
              <div class="row">
                <input type="text" class="form__input" name='b' id="b" placeholder="Inputkan Modal Anda" required>
              </div>
              <div class="row">
                <button type="submit" class="btn" name="login">Log In</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <div class="container-fluid text-center footer">
    All Right Reserved &hearts; by <a href="#">Mediatama Web Indonesia</a></p>
  </div>

  <script src="assets/libs/jquery/jquery-3.4.1.min.js"></script>
  <script>
    $(function() {
      $("#b").focus();
      $("#b").number(true, 0);
    });
  </script>
</body>

</html>

<?php

if (isset($_POST['login'])) {
  $b = mysql_real_escape_string($_POST['b']);
  mysql_query("INSERT into tb_modal values('','$_SESSION[kasir]',now(),'$b')");
?>
  <script>
    window.location.href = "index.php";
  </script>

<?php
}
?>