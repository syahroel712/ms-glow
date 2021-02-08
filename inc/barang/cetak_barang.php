<font face="arial" class="text-error text-center">
  <?php
  include "../koneksi.php";
  $kd_brg = @$_GET['id'];
  $sql2 = mysql_query("SELECT * FROM tb_barang WHERE kode_barang = '$kd_brg'") or die(mysql_error());
  $data2 = mysql_fetch_array($sql2);

  ?>

  <body onLoad="javascript:print()">
    <table width="80%" border="0">
      <tr>
        <td>
          <b><?= $data2['nama_barang'] ?></b>
        </td>
      </tr>
      <tr>
        <td>
          <?= $data2['kode_barang'] ?>
        </td>
      </tr>
      <tr>
        <td>
          Rp. <?= number_format($data2['harga_jual']) ?>
        </td>
      </tr>
    </table>


</font>