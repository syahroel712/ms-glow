<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="./" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
          Data Master
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="?page=barang&action=view" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Stok Barang</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="?page=kategori&action=view" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Kategori</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="?page=pemasok&action=view" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Supplier</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="?page=member&action=view" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Member</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="?page=user&action=view" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Data User</p>
          </a>
        </li>
      </ul>
    </li>

    <!--<li class="nav-item">
      <a href="index.php?page=data_satuan" class="nav-link">
        <i class="nav-icon fa fa-book"></i>
        <p>Data Satuan</p>
      </a>
    </li>-->

    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-edit"></i>
        <p>
          Data Transaksi
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="index.php?page=penjualan&action=view" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Penjualan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=pembelian&action=view" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Pembelian</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=pengembalian&action=view" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Return</p>
          </a>
        </li>
	<!--
		<li class="nav-item">
          <a href="index.php?page=kanvas&action=view" class="nav-link">
            <i class="far fa-newspaper nav-icon"></i>
            <p>Data Kanvas</p>
          </a>
        </li>
	-->
      </ul>
    </li>

    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-edit"></i>
        <p>
          Transaksi
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="index.php?page=penjualan&action=input" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Penjualan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=pembelian&action=input" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Pembelian</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=pengembalian&action=input" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Return</p>
          </a>
        </li>
	<!--
		<li class="nav-item">
          <a href="index.php?page=kanvas&action=input" class="nav-link">
            <i class="far fa-newspaper nav-icon"></i>
            <p>Kanvas</p>
          </a>
        </li>
	-->
      </ul>
    </li>

    <li class="nav-item">
      <a href="index.php?page=kas&action=view" class="nav-link">
        <i class="nav-icon fa fa-book"></i>
        <p>Buku Kas</p>
      </a>
    </li>

    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-book"></i>
        <p>
          Laporan Penjualan
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="?page=laporan_perhari" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Laporan Penjualan</p>
          </a>
        </li>
        <!--<li class="nav-item">-->
        <!--  <a href="?page=laporan_perbulan" class="nav-link">-->
        <!--    <i class="far fa-circle nav-icon"></i>-->
        <!--    <p>Laporan Perbulan</p>-->
        <!--  </a>-->
        <!--</li>-->
        <!--<li class="nav-item">-->
        <!--  <a href="?page=laporan_pertahun" class="nav-link">-->
        <!--    <i class="far fa-circle nav-icon"></i>-->
        <!--    <p>Laporan Pertahun</p>-->
        <!--  </a>-->
        <!--</li>-->
        <li class="nav-item">
          <a href="?page=laporan_perbarang" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Laporan Perbarang</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="?page=laporan_perkategori" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Laporan Perkategori</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="?page=laporan_perkaryawan" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Laporan Perkaryawan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="?page=laporan_persupplier" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Laporan Persupplier</p>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-book"></i>
        <p>
          Laporan Pembelian
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="?page=laporan_perhari_pembelian" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Laporan Pembelian</p>
          </a>
        </li>
        <!--
        <li class="nav-item">
          <a href="?page=laporan_perbulan_pembelian" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Laporan Perbulan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="?page=laporan_pertahun_pembelian" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Laporan Pertahun</p>
          </a>
        </li>
	-->
        <li class="nav-item">
          <a href="?page=laporan_persupplier_pembelian" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Laporan Persupplier</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a href="?page=laporan_keuangan" class="nav-link">
        <i class="nav-icon fa fa-book"></i>
        <p>Laporan Keuangan</p>
      </a>
    </li>
<!--
    <li class="nav-item">
      <a href="?page=laporan_so" class="nav-link">
        <i class="nav-icon fa fa-book"></i>
        <p>Laporan SO</p>
      </a>
    </li>
-->
    <li class="nav-item">
      <a href="?page=laporan_permember" class="nav-link">
        <i class="nav-icon fa fa-book"></i>
        <p>Laporan Member</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="?page=setting" class="nav-link">
        <i class="nav-icon fa fa-cog"></i>
        <p>Setting</p>
      </a>
    </li>

    <?php
    $kadaluarsa = mysql_fetch_assoc(mysql_query("SELECT kadaluarsa FROM tb_visi"));
    $tglskrg = date('Y-m-d');
    $awal = strtotime($tglskrg);
    $akhir = strtotime($kadaluarsa['kadaluarsa']);
    $diff  = $akhir - $awal;
    $selisih = floor($diff / (60 * 60 * 24));

    if ($selisih <= 7) {
    ?>
      <li class="nav-item">
        <a href="" class="nav-link" data-toggle="modal" data-target="#aktivasiModal">
          <i class="nav-icon fa fa-credit-card"></i>
          <p>Perpanjangan</p>
        </a>
      </li>
    <?php } ?>
  </ul>
</nav>