<nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <?php
  $tgl_skr = date('m-d');
  $ulang_tahun = mysql_fetch_assoc(mysql_query("SELECT GROUP_CONCAT(nm) AS nm from tb_member WHERE RIGHT(tgl_lahir, 5) = '$tgl_skr'"));
  if(!empty($ulang_tahun['nm']))
  {
    $list_nama_ulang_tahun = explode(",", $ulang_tahun['nm']);
    if(count($list_nama_ulang_tahun) > 1)
    {

      $list_nama_ulang_tahun[count($list_nama_ulang_tahun) - 1] = " dan ".$list_nama_ulang_tahun[count($list_nama_ulang_tahun) - 1];

      foreach ($list_nama_ulang_tahun as $no => $nama)
      {
        if($no < count($list_nama_ulang_tahun) - 2)
        $list_nama_ulang_tahun[$no] .= ", ";
      }

    }

    $nama_ulang_tahun = "";

    foreach ($list_nama_ulang_tahun as $no => $nama)
    {
      $nama_ulang_tahun .= $nama;
    }
  ?>
    <marquee><span class="logo-lg alert-danger" style="color:white;padding:5px;border-radius:10px;"><b> Hari Ini Member Dengan Nama <?php echo $nama_ulang_tahun; ?> Sedang Berulang Tahun..</b></span></marquee>
  <?php
  }
  ?>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a onclick="return confirm('Yakin untuk logout ?');" href="logout.php" class="nav-link">
        <img src="assets/img/logo.png" width="30"> Logout</a>
    </li>
  </ul>
</nav>