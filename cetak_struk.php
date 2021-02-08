</script>
<font face="arial">
  <?php
  include "inc/koneksi.php";
  include "inc/tglindo.php";
  $tot = 0;
  $id_brg = @$_GET['id'];
  $sql2 = mysql_query("select * from tb_penjualan where no_nota = '$id_brg'") or die(mysql_error());
  $data2 = mysql_fetch_array($sql2);

  $k = mysql_fetch_array(mysql_query("select * from tb_user where nama_lengkap='$data2[kasir]'"));

  $setting = mysql_fetch_assoc(mysql_query("SELECT * FROM setting"));
  ?>

  <body onLoad="javascript:print()">
    <table width="100%" border="0" align="center">
      <tr>
        <td colspan="3" align='center'>
          <div>
            <font size=2><?= $setting['nama_toko'] ?> </font>
          </div>
          <div>
            <font size=2><?= $setting['alamat'] ?></font>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan=3>&nbsp;</td>
      </tr>
      <tr>
        <td width="114">
          <font size=2>No Nota</font>
        </td>
        <td width="1">
          <font size=2>:</font>
        </td>
        <td>
          <font size=2><?php echo $data2['no_nota']; ?></font>
        </td>
      </tr>
      <tr>
        <td colspan=3>
          <font size=2><?php echo TanggalIndo($data2['tgl_jual']); ?> - <?php echo $k['username']; ?></font>
        </td>
      </tr>
      <tr>
        <td colspan=3>
          <table border=0 cellspacing=0 width="100%">
            <tr>
              <th colspan=6>
                <hr />
              </th>
            </tr>
            <?php
            $b = mysql_query("select *,sum(jumlah_jual)as tot from tb_barang_terjual where no_nota='$_GET[id]' group by kode_barang");
            while ($r = mysql_fetch_array($b)) {
              $harga = $r['harga_satuan'] * $r['tot'];
              $hasil = ($harga * $r['disc']) / 100;
              // $total = $harga - $hasil;


              $diskon = $r['disc'] / $r['tot'];
              $hargadiskon = $diskon;
              $totdiskon = $r['harga_satuan'] - $hargadiskon;
              $total = $totdiskon * $r['jumlah_jual'];

              echo "
  <tr>
	<td colspan=6><font size=2>" . substr($r['nama_barang'], 0, 20) . "</font></td>
  </tr>
  <tr>
	<td align='center'><font size=2>$r[tot]</font></td>
	<td align='right'><font size=2>X</font></td>
	<td align='right'><font size=2>" . number_format($r['harga_satuan'], 0) . "</font></td>
	<td align='right'><font size=2>" . number_format($harga, 0) . "</font></td>
	<td align='right'><font size=2>Disc: " . number_format($diskon, 0) . "</font></td>
	<td align='right'><font size=2>" . number_format($total, 0) . "</font></td>
	</tr>
  ";
              $tot += $total;
            }
            ?>
            <tr>
              <th colspan=6>
                <hr />
              </th>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <font size=1>Sub Total </font>
        </td>
        <td>:Rp.</td>
        <td align='right'>
          <font size=1><?php echo number_format($tot, 0); ?></font>
        </td>
      </tr>
      <tr>
        <td>
          <font size=1>Diskon Member</font>
        </td>
        <td>:Rp.</td>
        <td align='right'>
          <font size=1><?php echo number_format($data2[diskon_total], 0); ?></font>
        </td>
      </tr>

      <tr>
        <td>
          <font size=1>Total Harga</font>
        </td>
        <td>:Rp.</td>
        <td align='right'>
          <font size=1><?php echo number_format($tot - $data2[diskon_total], 0); ?></font>
        </td>
      </tr>

      <tr>
        <td>
          <font size=1>Bayar </font>
        </td>
        <td>:Rp.</td>
        <td align='right'>
          <font size=1><?php echo number_format($data2['bayar'], 0); ?></font>
        </td>
      </tr>
      <tr>
        <td>
          <font size=1>Kembali </font>
        </td>
        <td>:Rp.</td>
        <td align='right'>
          <font size=1><?php echo number_format($data2['bayar'] - ($tot - $data2['diskon_total']), 0); ?></font>
        </td>
      </tr>
    </table>
    <center>
      <font size=2>* Terima Kasih*</font>
    </center>
</font>