<?php
include "koneksi.php";
$kodemember = @mysql_real_escape_string($_POST['kodemember']);
$sql = mysql_query("select * from tb_member where id_member = '$kodemember'") or die (mysql_error());
$data = mysql_fetch_array($sql);
$cek = mysql_num_rows($sql);
if($cek > 0) { 
$d=mysql_fetch_array(mysql_query("select * from diskon"));
?>
	<script type="text/javascript">
	$("#namamember").val("<?php echo $data['nm']; ?>");	
	$("#persen").val("<?php echo $d['dc']; ?>");
		
		var diskonpersen = $("#persen").val();
		var subtotal = $("#subtotal").val();
		$("#diskonharga").val(subtotal*diskonpersen/100);

		var diskonharga = $("#diskonharga").val();
		$("#totalharga").val(subtotal-diskonharga);
		$("#tagihan").text(subtotal-diskonharga).number(true, 0);
	</script> <?php
} else {
	?> <script type="text/javascript">
	$("#namamember").val("");
	</script> <?php
}
?>