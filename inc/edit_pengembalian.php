<?php
$id_brg = @$_GET['id'];
$sql2 = mysql_query("select * from tb_barang where kode_barang = '$id_brg'") or die (mysql_error());
$data2 = mysql_fetch_array($sql2);
?>
<title>Edit Data Barang</title>
<fieldset>
   	<legend>Edit Data Barang</legend>
    <table>
        <tr>
        	<td>Kode Barang</td>
	        <td>:</td>
            <td><input type="text" id="kd_brg" value="<?php echo $data2['kode_barang']; ?>" disabled="disabled" /></td>
        </tr>
		<tr>
        	<td>Nama Barang</td>
	        <td>:</td>
            <td><input type="text" id="nm_brg" value="<?php echo $data2['nama_barang']; ?>" /></td>
        </tr>
        <tr>
        	<td>Perusahaan Pemasok</td>
	        <td>:</td>
            <td><select name="satuan" id="satuan" onchange="changeValue(this.value)" >
        <option value=0>-Pilih-</option>
        <?php
    $result = mysql_query("select * from tb_pemasok");   
        
    while ($row = mysql_fetch_array($result)) {   
        echo '<option value="' . $row['perusahaan'] . '">' . $row['perusahaan'] . '</option>';   
       
    }     
    ?>   
        </select>  </td>
        </tr>
       
       
        <tr>
        	<td>Jumlah Pembelian</td>
	        <td>:</td>
            <td><input type="text" id="s_awal"  /></td>
        </tr>
        
        <tr>
        	<td></td>
            <td></td>
            <td><button id="edit">Beli</button></td>
        </tr>
	</table>
	<script>

		$(window).load(function() {
        	$("#hb").number(true, 2);
        	$("#hj").number(true, 2);
        });

		$("#edit").click(function(){
			var kd_brg = $("#kd_brg").val();
			var nm_brg = $("#nm_brg").val();
			var satuan = $("#satuan").val();
			
			var s_awal = $("#s_awal").val();
			
			if(kd_brg == '')
			{
				alert("Kode Barang tidak boleh kosong");
				$("#kd_brg").focus();
			}
			else if(nm_brg == '')
			{
				alert("Nama Barang tidak boleh kosong");
				$("#nm_brg").focus();
			}
			else if(satuan == '')
			{
				alert("Satuan tidak boleh kosong");
				$("#satuan").focus();
			
			}
			else if(s_awal == '')
			{
				alert("Stok awal jual tidak boleh kosong");
				$("#s_awal").focus();
			}
			
			else
			{
				$.ajax({
					type : 'post',
					url : 'inc/proses_edit_pembelian.php',
					data : 'kd_brg='+kd_brg+'&nm_brg='+nm_brg+'&satuan='+satuan+'&s_awal='+s_awal,
					success : function(msg){
						$("#hasil_edit").html(msg);
					}
				});
			}
		});

	</script>
	<div id="hasil_edit"></div>
</fieldset>