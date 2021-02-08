<?php
$homethn = date('Y');

$homebarang = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM tb_barang"));
$homekasir = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM tb_user where level='kasir'"));
$homesupplier = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM tb_supplier"));

$hometotal_penjualan = mysql_fetch_array(mysql_query("SELECT sum(total_harga) as total FROM tb_penjualan where year(tgl_jual)='$homethn'"));
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">

    <div class="row mb-4">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?php echo $homebarang['total']; ?></h3>

            <p>Barang</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="index.php?page=barang&action=view" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?php echo $homekasir['total']; ?></h3>

            <p>Kasir</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="index.php?page=user&action=view" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?php echo $homesupplier['total']; ?></h3>

            <p>Supplier</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="index.php?page=pemasok&action=view" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?= $hometotal_penjualan['total'] == 0 ? "Rp. " . number_format("0", 2) : "Rp. " . number_format($hometotal_penjualan['total'], 0, ',', '.'); ?></h3>

            <p>Total Penjualan</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="index.php?page=penjualan&action=view" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-7">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-bar mr-1"></i>Penjualan Tahun <?php echo $homethn; ?></h3>
              </div>
              <!-- /.box-header -->
              <div class="card-body">
                <canvas id="myBarChart7" height="100"></canvas>
              </div>
              <!-- /.box-body -->
            </div>
          </div>
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-bar mr-1"></i>Barang terlaris bulan ini</h3>
              </div>
              <div class="card-body">
                <canvas id="myLineChart2" height="150"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-exclamation-triangle mr-1"></i>Stok kurang dari 5</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive-sm">
              <table id="example2" class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Stok Tersisa</th>
                  </tr>
                </thead>
                <tbody id="barang">
                  <?php
                  $no = 0;
                  $sql = mysql_query("SELECT * from tb_barang WHERE stok_sisa < 5");
                  $no++;
                  $cek = mysql_num_rows($sql);
                  if ($cek < 1) {
                  ?>
                    <tr>
                      <td colspan="14" style="padding:10px;">Data tidak ditemukan</td>
                    </tr>
                    <?php
                  } else {
                    while ($data = mysql_fetch_array($sql)) {

                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data['nama_barang']; ?></td>
                        <td class="text-danger text-bold"><?php echo $data['stok_sisa']; ?></td>
                      </tr>
                  <?php
                      $no++;
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>