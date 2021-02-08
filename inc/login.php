<title>Halaman Login</title>

<style>
#canvas{
	width:300px;
	margin:0 auto;
	margin-top:100px;
}
#judul{
	border-bottom:5px solid #f60;
	background-color:#f90;
	color:#fff;
	font-family:"Franklin Gothic Medium", "Franklin Gothic Demi", "Franklin Gothic Book";
	font-size:18px;
	padding:10px;
	text-align:center;
	border-top-left-radius:5px;
	border-top-right-radius:5px;
}
#form{
	padding:15px;
	background-color:#ccc;
	border-bottom-left-radius:5px;
	border-bottom-right-radius:5px;
}

input[type="text"], input[type="password"]{
	padding:10px;
}
</style>

<div id="canvas">
	<div id="judul">Halaman Login</div>
    <div id="form">
    	<div id="pesan">Username tidak boleh kosong</div>
    	<table align="center">
        	<tr>
            	<td><input type="text" id="user" placeholder="Masukkan username" /></td>
            </tr>
            <tr>
            	<td>
					<select id="level">
						<option value="Admin">Admin</option>
						<option value="Kasir">Kasir</option>
						<option value="Pimpinan">Pimpinan</option>
					</select>
				</td>
            </tr>
            <tr>
            	<td><input type="password" id="pass" placeholder="Masukkan password" /></td>
            </tr>
            <tr>
            	<td><button id="masuk">Masuk</button></td>
            </tr> 
        </table>
        <script>
		function masuk(){
			var user = $("#user").val();
			var pass = $("#pass").val();
			var level = $("#level").val();
			if(user == "")
			{
				$("#pesan").fadeIn(1000).html("Username tidak boleh kosong");
				$("#user").focus();
			}
			else if(pass == "")
			{
				$("#pesan").fadeIn(1000).html("Password tidak boleh kosong");
				$("#pass").focus();
			}
			else
			{
				$("#pesan").css({"background-color":"rgba(255,204,0,0.6)", "border-left":"5px solid #fc0"}).fadeIn(1000).html("Sedang verifikasi...");
				$.ajax({
					type : 'post',
					url : 'inc/proses_login.php',
					data : 'user='+user+'&pass='+pass+'&level='+level,
					success : function(msg){
						$("#pesan").delay(600).fadeOut(1000, function(){
							$(this).fadeIn(1000).html(msg);
						});
					}
				});
			}
		}
		
		$("#masuk").click(function(){
			masuk();
		});
		
		$("#pass").keyup(function(e){
			if(e.keyCode == 13)
			{
				masuk();
			}
		});
		</script>
    </div>
</div>