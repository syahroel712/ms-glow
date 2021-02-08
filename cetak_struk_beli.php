<font face="arial" class="text-error text-center">
  <?php
  include "inc/koneksi.php";
  $id_brg = @$_GET['id'];
  $sql2 = mysql_query("select * from tb_pembelian where nota = '$id_brg'") or die(mysql_error());
  $data2 = mysql_fetch_array($sql2);
  $sup = mysql_fetch_array(mysql_query("select * from tb_supplier where idsup='$data2[idsup]'"));

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
        <td width="114">No Nota Beli</td>
        <td width="1">:</td>
        <td><?php echo $data2['nota']; ?></td>
      </tr>
      <tr>
        <td width="114">Supplier</td>
        <td width="1">:</td>
        <td><?php echo $sup['nmsup']; ?></td>
      </tr>
      <tr>
        <td colspan=3> <?php echo $data2['tgl_beli']; ?> - Admin -> <?php echo $data2['kasir']; ?></td>
      </tr>
      <tr>
        <td colspan=3>
          <table border=0 cellspacing=0 width="100%">
            <tr>
              <th colspan=4>
                <hr />
              </th>
            </tr>
            <?php
            $tot = 0;
            $b = mysql_query("select *,sum(jml)as tot from tb_barang_terbeli where nota='$_GET[id]' group by kode_barang");
            while ($r = mysql_fetch_array($b)) {
              echo "
  <tr>
	<td colspan=4>$r[nama_barang]</td>
  </tr>
  <tr>
	<td align='center'>$r[tot]</td>
	<td align='right'>X</td>
	<td align='right'>" . number_format($r['harga_satuan'], 0) . "</td>
	<td align='right'>" . number_format(($r['harga_satuan'] * $r['tot']), 0) . "</td>
	</tr>
  ";
              $tot = $tot + ($r['harga_satuan'] * $r['tot']);
            }
            ?>
            <tr>
              <th colspan=4>
                <hr />
              </th>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>Total Harga Rp.</td>
        <td>: </td>
        <td align='right'><?php echo number_format($tot, 0); ?></td>
      </tr>

      <tr>
        <td>Diskon </td>
        <td>:</td>
        <td align='right'> <?php echo number_format($data2['diskon_persen'], 0); ?>%</td>
      </tr>
      <tr>
        <td>Diskon Hrg Rp.</td>
        <td>:</td>
        <td align='right'><?php echo number_format($tot * ($data2['diskon_persen'] / 100), 0); ?></td>
      </tr>
      <tr>
        <td>PPn </td>
        <td>:</td>
        <td align='right'> <?php echo number_format($data2['ppn'], 0); ?>%</td>
      </tr>

      <tr>
        <td>Total Harga Rp.</td>
        <?php
        $t1 = $tot - ($tot * $data2['diskon_persen'] / 100);
        $t2 = $t1 * $data2['ppn'] / 100;
        ?>
        <td>:</td>
        <td align='right'><?php echo number_format($t1 + $t2, 0); ?></td>
      </tr>
    </table>

</font>