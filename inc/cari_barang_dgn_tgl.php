<select id="cari_barang_dgn_tgl">
	<option value="">-- Pilih tanggal --</option>
    <?php
	$sql_tgl = mysql_query("select distinct(tanggal) from tb_barang") or die (mysql_error());
	while($data_tgl = mysql_fetch_array($sql_tgl)){
		?>
        <option value="<?php echo $data_tgl['tanggal']; ?>"><?php echo $data_tgl['tanggal']; ?></option>
        <?php
	}
	?>
</select>