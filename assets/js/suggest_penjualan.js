// variabel untuk menampung data satuan saat transaksi
var _data_satuan = [];
// variabel menampung barang yang sedang dipilih
var _barang_terpilih = {};

//Fungsi untuk autosuggest
function suggest(src) {
	var page = 'inc/suggest.php';
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

// ambil data barang beserta satuannya
// function ambilDetailBarang(kode_barang) {
// 	$.ajax({
// 		url: "inc/detail-barang.php",
// 		data: 'kode_barang=' + kode_barang,
// 		type: "get",
// 		dataType: "html",
// 		timeout: 10000,
// 		success: function (response) {
// 			var data_barang = JSON.parse(response);
// 			_data_satuan = data_barang.list_satuan;
// 			var data_satuan = "";
// 			for (var x = 0; x < data_barang.list_satuan.length; x++) {
// 				data_satuan += "<option value='" + data_barang.list_satuan[x].id_satuan + "'>" + data_barang.list_satuan[x].nama_satuan + "</option>";
// 			}

// 			document.getElementsByName("nama_satuan")[0].innerHTML = data_satuan;

// 			TampilHargaSatuanBarang();
// 		}
// 	});
// }

// function TampilHargaSatuanBarang() {
// 	var barang_terpilih = document.getElementsByName("nama_satuan")[0].selectedIndex;
// 	_barang_terpilih = _data_satuan[barang_terpilih];
// 	document.getElementById("harga_satuan").value = _data_satuan[barang_terpilih].harga_satuan;
// 	document.getElementById("jumlahjual").value = _data_satuan[barang_terpilih].konversi_stok;
// }


//Fungsi untuk memilih nama barang dan memasukkannya pada input text
function pilih_barang(kota) {
	$('#namabarang').val(kota);
}
function pilih_kode(kota) {
	$('#kodebarang').val(kota);
}
function pilih_stok(kota) {
	$('#stokbarang').val(kota);
}
function pilih_hrg(kota) {
	$("#hargabarang").val(kota);
	$("#harga_satuan").val(kota);
	$("#hargaakhir").val(kota);
	//$('#kode').val(kota);
}

function pilih_disk(kota) {
	$('#diskonharga').val(kota);
	$('#disko').val(kota);
}

function pilih_stok(kota) {
	$('#stokbarang').val(kota);
	//$('#kode').val(kota);
	if ($("#manual:checked").val()) {
		$("#jumlahjual").focus();
	} else {
		// 		$("#simpanitem").click();
		$("#namabarang").val("");
		$("#diskonharga").focus();

	}
}


//menampilkan form div
function showStuff(id) {
	document.getElementById(id).style.display = 'block';
}
//menyembunyikan form
function hideStuff(id) {
	document.getElementById(id).style.display = 'none';
}

// document.getElementsByName("nama_satuan")[0].addEventListener("change", TampilHargaSatuanBarang);

