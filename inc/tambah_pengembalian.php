<title>Pembelian</title>

<fieldset>
<legend>Pembelian</legend>
    <table>
    <tr>
    	<td>Nama Barang</td>
        <td>:</td>
        <td><input type="text" id="nm" /></td>
    </tr>
	<tr>
    	<td>Perusahaan</td>
        <td>:</td>
        <td> <select name="perusahaan" id="perusahaan" onchange="changeValue(this.value)" >
        <option value=0>-Pilih-</option>
        <?php
    $result = mysql_query("select * from tb_pemasok");   
        
    while ($row = mysql_fetch_array($result)) {   
        echo '<option value="' . $row['perusahaan'] . '">' . $row['perusahaan'] . '</option>';       
    }     
    ?>   
        </select>   </td>
    </tr>
    <tr>
    	<td>Stok</td>
        <td>:</td>
        <td><textarea id="alamat"></textarea></td>
    </tr>
    <tr>
    	<td>No Hp</td>
        <td>:</td>
        <td>
        	<input type="text" id="nohp" />   </td>
    </tr>
    
        <tr>
    	<td></td>
        <td></td>
        <td><button id="tambah">Tambah</button></td>
    </tr>
    <tr>
	    <td></td>
    </tr>
    </table>

<script>

	$("#tambah").click(function() {
		var nm = $("#nm").val();
		var perusahaan = $("#perusahaan").val();
		var alamat = $("#alamat").val();
		var nohp = $("#nohp").val();
		
		if(nm == '') {
			alert("Nama Lengkap tidak boleh kosong");
			$("#nm").focus();
		} else if(perusahaan == '') {
			alert("Perusahaan tidak boleh kosong");
			$("#perusahaan").focus();
		} else if(alamat == '') {
			alert("Alamat tidak boleh kosong");
			$("#alamat").focus();
		} else if(nohp == '') {
			alert("NO hp tidak boleh kosong");
			$("#nohp").focus();
		
		} else {
			$.ajax({
				type : 'post',
				url : 'inc/proses_tambah_pemasok.php',
				data : 'nm='+nm+'&perusahaan='+perusahaan+'&alamat='+alamat+'&nohp='+nohp,
				success : function(msg){
					$("#hasil_tambah").html(msg);
				}
			});
		}
	});
	</script>

    <div id="hasil_tambah"></div>
</fieldset>