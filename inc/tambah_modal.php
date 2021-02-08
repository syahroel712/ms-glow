<?php
if(isset($_POST[simpan])){
	$cek=mysql_query("select * from tb_modal where id_user='$_POST[kasir]' and tgl='$_POST[tgl]'");
		if(mysql_num_rows($cek)>0){
		?>
		<script>
		alert("data sudah ada");
		//window.location.href='./?page=modal&action=view';
		</script>
		<?php

		}else{
		mysql_query("insert into tb_modal values('','$_POST[kasir]','$_POST[tgl]','$_POST[modal]')");
		?>
		<script>
		alert("data tersimpan");
		window.location.href='./?page=modal&action=view';
		</script>
		<?php		
		}
	}
?>
<title>Tambah modal</title>

<fieldset>
<legend>Tambah modal</legend>
<form action='' method='post'>
    
	<table class='table table-condensed table-bordered'>
    <tr>
    	<td width='150px' scope='row'>Kasir</td>
        <td>:</td>
        <td>
		<select class="form-control" name="kasir" >
			<option value="">Pilih</option>
			<?php 
			$k=mysql_query("select * from tb_user where level='kasir' order by nama_lengkap");
			while($rk=mysql_fetch_array($k)){
			if($data['id_user']=="$rk[kode_user]"){
			$selected="selected";
			}else{
			$selected="";
			}
			echo"<option value='$rk[kode_user]' $selected>$rk[nama_lengkap]</option>";
			}
			?>
		</select>
		</td>
    </tr>
    <tr>
    	<td>Tanggal</td>
        <td>:</td>
        <td>
        	<input class="form-control" type="date" name="tgl" value="<?php echo date('Y-m-d'); ?>" />
        </td>
    </tr>
    <tr>
    	<td>Modal</td>
        <td>:</td>
        <td>
        	<input class="form-control" type="text" name="modal" id="modal" value="<?php //echo $data['modal']; ?>" />
        </td>
    </tr>
   
    <tr>
    	<td></td>
        <td></td>
        <td><input type='submit' name="simpan" id="simpan" value='simpan' class="btn btn-primary"></td>
    </tr>
    <tr>
	    <td></td>
    </tr>
    </table>
</form><div id="hasil_edit"></div>
<script src="./jquery.js"></script>
    <script src="./jquery-ui.js"></script>
    <script src="./jquery-number.js"></script>
	
<script type="text/javascript">
$(window).load(function(){
		$("#modal").number(true, 0);
</script>

    <div id="hasil_tambah"></div>
</fieldset>