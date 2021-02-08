<font face="arial" class="text-error text-center">
  <?php
  session_start();
  include "inc/koneksi.php";
  $kode_user = $_SESSION['kasir'];
  $sql_user = mysql_query("SELECT * from tb_user where kode_user = '$kode_user'") or die(mysql_error());
  $data_user = mysql_fetch_array($sql_user);
  $skr = date('Y-m-d');
  $modal = mysql_fetch_array(mysql_query("SELECT * from tb_modal where id_user='$kode_user' and tgl='$skr'"));
  $pe = mysql_fetch_array(mysql_query("SELECT *,sum(d.harga_akhir)as tot from tb_penjualan p,tb_barang_terjual d where p.no_nota=d.no_nota and date(p.tgl_jual)='$skr' and p.kasir='$data_user[nama_lengkap]'"));

  $setting = mysql_fetch_assoc(mysql_query("SELECT * FROM setting"));
  ?>

  <body onLoad="javascript:print()">
    <table width="100%" border="0" align="center">
      <tr>
        <td colspan="3" align='center'>
          <div><?= $setting['nama_toko'] ?></</div> <div><?= $setting['alamat'] ?></div>
        </td>
      </tr>
      <tr>
        <td colspan=3>&nbsp;</td>
      </tr>
      <tr>
        <td width="114">Tanggal</td>
        <td width="1">:</td>
        <td><?php echo $_GET['tgl_jual']; ?></td>
      </tr>
      <tr>
        <td width="114">Kasir</td>
        <td width="1">:</td>
        <td><?php echo $data_user['nama_lengkap']; ?></td>
      </tr>
      <tr>
        <td colspan=3>
          <table border=0 cellspacing=0 width="100%">
            <tr>
              <th colspan=4>
                <hr />
              </th>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan=2>Modal</td>
        <td>Rp. <?= number_format($modal['modal'], 0) ?></td>
      </tr>
      <tr>
        <td colspan=2>Penjualan</td>
        <td>Rp. <?= number_format($pe['tot'], 0) ?></td>
      </tr>
      <tr>
        <td colspan=2>Total</td>
        <td>Rp. <?= number_format($modal['modal'] + $pe['tot'], 0) ?></td>
      </tr>
    </table>
    <br>
    <center>
      <font size=2>* Terima Kasih*</font>
    </center>