<title>Edit Data modal</title>

<fieldset>
<legend>Edit Data modal</legend>

    <?php
    $id = @$_GET['id'];
    
	if(isset($_POST[edit])){
	//$cek=mysql_query("select * from tb_modal where id_user='$_POST[kasir]' and tgl='$_POST[tgl]'");
		//if(mysql_num_rows>0){
		mysql_query("update tb_modal set modal='$_POST[modal]' where id_modal='$_GET[id]'");
		?>
		<script>
		alert("data tersimpan");
		window.location.href='./?page=modal&action=view';
		</script>
		<?php
		
	}
    $sql = mysql_query("select * from tb_modal where id_modal = '$id'") or die (mysql_error());
    $data = mysql_fetch_array($sql);
	
	?><form action='' method='post'>
    <table class='table table-condensed table-bordered'>
    <tr>
    	<td width='150px' scope='row'>Kasir</td>
        <td>:</td>
        <td>
		<select class="form-control" name="kasir" disabled=disabled>
			<option value="">Pilih Kasir</option>
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
		<input class="form-control" type="hidden" hidden=hidden name="id" value="<?php echo $_GET['id']; ?>" />
		</td>
    </tr>
    <tr>
    	<td>Tanggal</td>
        <td>:</td>
        <td>
        	<input class="form-control" type="date" disabled name="tgl" value="<?php echo $data['tgl']; ?>" />
        </td>
    </tr>
    <tr>
    	<td>Modal</td>
        <td>:</td>
        <td>
        	<input class="form-control" type="text" name="modal" id="modal" value="<?php echo $data['modal']; ?>" />
        </td>
    </tr>
   
    <tr>
    	<td></td>
        <td></td>
        <td><input type='submit' name="edit" id="edit" value='Edit' class="btn btn-primary"></td>
    </tr>
    <tr>
	    <td></td>
    </tr>
    </table>
</form>
    <div id="hasil_edit"></div>
<script src="./jquery.js"></script>
    <script src="./jquery-ui.js"></script>
    <script src="./jquery-number.js"></script>
	<script type="text/javascript">
$(window).load(function(){
		$("#modal").number(true, 0);
</script>

</fieldset>