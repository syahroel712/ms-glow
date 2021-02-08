//Fungsi untuk autosuggest
function suggest(src) {
	var page = 'inc/suggest_edit_penjualan.php';
	if (src.length >= 1) {
		var loading = '<p align="center">Loading ...</p>';
		showStuff('suggest');
		$('#suggest').html(loading);
		$.ajax({
			url: page,
			data: 'src=' + src,
			type: "post",
			dataType: "html",
			timeout: 10000,
			success: function (response) {
				$('#suggest').html(response);
			}
		});

		$('#kode').val("");
	} else {
		hideStuff('suggest');
		$('#kode').val("");
	}
}

//Fungsi untuk memilih kota dan memasukkannya pada input text
function pilih_kota(kota) {
	$('#namabarang').val(kota);
	//$('#kode').val(kota);
}
function pilih_kode(kota) {
	$('#kodebarang').val(kota);
	//$('#kode').val(kota);
}

function pilih_stok(kota) {
	$('#stokbarang').val(kota);
	$('#harga').val(kota);
	//$('#kode').val(kota);
	if ($("#manual:checked").val()) {
		$("#jumlahjual").focus();
	} else {
		$("#simpanitem").click();
		$("#kodebarang").val("");
		$("#namabarang").val("");
		$("#kodebarang").focus();

	}
}

function pilih_beli(kota) {
	$('#hargabeli').val(kota);
	//$('#kode').val(kota);
}
function pilih_satuan(kota) {
	$('#hargasatuan').val(kota);
	//$('#kode').val(kota);
}


//menampilkan form div
function showStuff(id) {
	document.getElementById(id).style.display = 'block';
}
//menyembunyikan form
function hideStuff(id) {
	document.getElementById(id).style.display = 'none';
}