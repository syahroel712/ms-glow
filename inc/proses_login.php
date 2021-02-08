<?php
@session_start();
include "koneksi.php";
$user = @mysql_real_escape_string($_POST['user']);
$pass = @mysql_real_escape_string($_POST['pass']);
$level = @mysql_real_escape_string($_POST['level']);
$sql = mysql_query("select * from tb_user where username = '$user' and password = md5('$pass') and level = '$level'") or die (mysql_error());
$cek = mysql_num_rows($sql);
if($cek >= 1)
{
	$data = mysql_fetch_array($sql);
	$id_user = $data['kode_user'];
	
	@$_SESSION['id'] = $id_user;
	if($data['level'] == "admin")
	{
		@$_SESSION['admin'] = $id_user;
		?> <script>
		window.location.href="index.php";
		</script> <?php
	}
	else if($data['level'] == "kasir")
	{
		@$_SESSION['kasir'] = $id_user;
		?> <script>
		window.location.href="index.php";
		</script> <?php
	}
	else if($data['level'] == "pimpinan")
	{
		@$_SESSION['pimpinan'] = $id_user;
		?> <script>
		window.location.href="index.php";
		</script> <?php
	}
}
else
{
	?> <script>
	$("#pesan").css({"background-color":"rgba(255,0,0,0.5)", "border-left":"5px solid #f00"}).html("Login gagal, mohon ulangi kembali");
	$("#user").val('');
	$("#pass").val('');
	$("#user").focus();
	</script> <?php
}
?>