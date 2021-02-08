<?php
session_start();
include "inc/koneksi.php";

if (isset($_POST['login'])) {
  $user = mysql_real_escape_string($_POST['username']);
  $pass = mysql_real_escape_string($_POST['password']);

  $sql = mysql_query("SELECT * from tb_user where username = '$user' and pass = '$pass'");
  $cek = mysql_num_rows($sql);
  if ($cek >= 1) {
    $data = mysql_fetch_array($sql);
    $id_user = $data['kode_user'];
    if ($data['level'] == "admin") {
      $_SESSION['admin'] = $id_user;
      $_SESSION['jk'] = $data['jenis_kelamin'];
      $_SESSION['kode_user'] = $data['kode_user'];
?>
      <script>
        window.location.href = "index.php";
      </script>
    <?php
    } else if ($data['level'] == "kasir") {
      $_SESSION['kasir'] = $id_user;
      $_SESSION['jk'] = $data['jenis_kelamin'];
      $_SESSION['kode_user'] = $data['kode_user'];
    ?>
      <script>
        window.location.href = "index.php";
      </script>

    <?php
    } else if ($data['level'] == "pimpinan") {
      $_SESSION['pimpinan'] = $id_user;
      $_SESSION['jk'] = $data['jenis_kelamin'];
    ?>
      <script>
        window.location.href = "index.php";
      </script>
<?php
    }
  } else {
    echo "<script>alert('Login Gagal');</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--<link rel="shortcut icon" href="assets/img/logo.png">-->
  <!--<link rel="stylesheet" href="assets/libs/bootstrap/css/bootstrap.min.css">-->
  <!--<link rel="stylesheet" href="assets/libs/fontawesome/css/all.min.css">-->
  <!--<link rel="stylesheet" href="assets/css/style.css">-->
  <title>Login Page</title>
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo_putih.png">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/fontawesome/css/font-awesome.min.css" />
  <link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="plugins/scroll/scrollbar.css">
  <link class="skin" rel="stylesheet" type="text/css" href="css/skin/skin-9.css">
  <link rel="stylesheet" type="text/css" href="css/templete.css">
  <link rel="stylesheet" type="text/css" href="css/switcher.css" />
</head>

<!--<body style="background-image: url('assets/img/bgbiru.jpg'); background-size: cover;">-->

<body id="bg">
  <div class="page-wrapers">
    <!-- Content -->
    <div id="particles-js" class="page-content dez-login bg-primary-dark">
      <div class="relative z-index3">
        <div class="top-head text-center p-a40">
          <a href="index.php"></a>

        </div>
        <br>
        <div class="login-form style-2">
          <div class="tab-content">
            <div id="login" class="tab-pane active text-center">
              <form class="p-a30 dez-form" method="post" action="">
                <!-- <h3 class="form-title m-t0">MKAMAL APPS 1.0</h3> -->
                <img src="assets/img/logo_putih.png" alt="logo" width="160">
                <p>Masukkan Username Dan Password. </p>
                <div class="dez-separator-outer m-b5">
                  <div class="dez-separator bg-primary style-liner"></div>
                </div>
                <div class="form-group">
                  <input name="username" id="username" required="" class="form-control" placeholder="Username" type="text" />
                </div>
                <div class="form-group">
                  <input name="password" id="password" required="" class="form-control " placeholder="Password" type="password" />
                </div>
                <div class="form-group text-left">
                  <input name="login" type="submit" value="Login" class="site-button pull-right">
                </div>
                <br>
              </form>
              <!-- <div class="bg-primary p-a15 bottom">
						<a data-toggle="tab" href="#developement-1" class="text-white">Create an account</a>
					</div> -->
            </div>
            <div id="forgot-password" class="tab-pane fade ">
              <form class="p-a30 dez-form text-center">
                <h3 class="form-title m-t0">Forget Password ?</h3>
                <div class="dez-separator-outer m-b5">
                  <div class="dez-separator bg-primary style-liner"></div>
                </div>
                <p>Enter your e-mail address below to reset your password. </p>
                <div class="form-group">
                  <input name="dzName" required="" class="form-control" placeholder="Email Id" type="text" />
                </div>
                <div class="form-group text-left"> <a class="site-button outline gray" data-toggle="tab" href="#login">Back</a>
                  <button class="site-button pull-right">Submit</button>
                </div>
              </form>
            </div>
            <div id="developement-1" class="tab-pane fade">
              <form class="p-a30 dez-form text-center text-center">
                <h3 class="form-title m-t0">Silakan Melapor Ke Admin</h3>

                <div class="form-group text-left ">
                  <a class="site-button outline gray" data-toggle="tab" href="#login">Back</a>
                  <!-- <button class="site-button pull-right">Submit</button> -->
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="bottom-footer text-center text-white">
          <p>Copyright <?php echo date('Y'); ?> © CV. Mediatama Web Indonesia</p>
        </div>
      </div>
    </div>
    <!-- Content END-->
  </div>
  <!-- Main Content -->
  <!--<div class="container-fluid">-->
  <!--  <div class="row main-content bg-success text-center">-->
  <!--    <div class="col-md-4 text-center company__info">-->
  <!--      <span class="company__logo">-->
  <!--        <h2><img src="assets/img/logo_putih.png" alt="logo" width="160"></h2>-->
  <!--      </span>-->
  <!--    </div>-->
  <!--    <div class="col-md-8 col-xs-12 col-sm-12 login_form">-->
  <!--      <div class="container-fluid">-->
  <!--        <div class="row">-->
  <!--          <h4 class="pt-4 pl-2">Masuk Untuk Melanjutkan</h4>-->
  <!--        </div>-->
  <!--        <div class="row">-->
  <!--                          <form class="p-a30 dez-form" method="post" action="proses_login.php">-->
  <!-- <h3 class="form-title m-t0">MKAMAL APPS 1.0</h3> -->
  <!--                              <img src="admin/assets/images/splash.png" class="img-rounded" alt="User Image" style="width: 150px;">-->
  <!--                              <p>Masukkan Username Dan Password. </p>-->
  <!--                              <div class="dez-separator-outer m-b5">-->
  <!--                                  <div class="dez-separator bg-primary style-liner"></div>-->
  <!--                              </div>-->
  <!--                              <div class="form-group">-->
  <!--                                  <input name="username" id="username" required="" class="form-control" placeholder="Email / Username" type="text" />-->
  <!--                              </div>-->
  <!--                              <div class="form-group">-->
  <!--                                  <input name="password" name="password" id="password" required="" class="form-control " placeholder="Password" type="password" />-->
  <!--                              </div>-->
  <!--                              <div class="form-group text-left">-->
  <!--                                  <input name="login" type="submit" value="Login" class="site-button pull-right">-->
  <!--                              </div>-->
  <!--                              <br>-->
  <!--                          </form>-->
  <!--<form class="form-group" method="POST">-->
  <!--  <div class="row">-->
  <!--    <input type="text" name="username" id="username" class="form__input" placeholder="Username">-->
  <!--  </div>-->
  <!--  <div class="row">-->
  <!-- <span class="fa fa-lock"></span> -->
  <!--    <input type="password" name="password" id="password" class="form__input" placeholder="Password">-->
  <!--  </div>-->
  <!--  <div class="row">-->
  <!--    <button type="submit" class="btn" name="login">Log In</button>-->
  <!--  </div>-->
  <!--</form>-->
  <!--        </div>-->
  <!--      </div>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</div>-->

  <script src="assets/libs/jquery/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <!-- jquery.min js -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- bootstrap.min js -->
  <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
  <!-- Form js -->
  <script type="text/javascript" src="js/jquery.bootstrap-touchspin.js"></script>
  <!-- Form js -->
  <script type="text/javascript" src="js/magnific-popup.js"></script>
  <!-- magnific-popup js -->
  <script type="text/javascript" src="js/waypoints-min.js"></script>
  <!-- waypoints js -->
  <script type="text/javascript" src="js/counterup.min.js"></script>
  <!-- counterup js -->
  <script type="text/javascript" src="js/jquery.countdown.js"></script>
  <!-- jquery countdown -->
  <script type="text/javascript" src="js/imagesloaded.js"></script>
  <!-- masonry  -->
  <script type="text/javascript" src="js/masonry-3.1.4.js"></script>
  <!-- masonry  -->
  <script type="text/javascript" src="js/masonry.filter.js"></script>
  <!-- masonry  -->
  <script type="text/javascript" src="js/owl.carousel.js"></script>
  <!-- OWL  Slider  -->
  <script type="text/javascript" src="js/custom.min.js"></script>
  <!-- custom fuctions  -->
  <script type="text/javascript" src="js/dz.carousel.js"></script>
  <!-- sortcode fuctions  -->
  <!-- switcher fuctions -->
  <script type="text/javascript" src="js/switcher.min.js"></script>
  <!-- particles  -->
  <script src="js/particles.js"></script>
  <script src="js/particles.app.js"></script>
</body>

</html>