<?php
 //menggunakan class phpExcelReader
 include "excel_reader2.php";
 
//koneksi ke db mysql
 include_once("inc/koneksi.php");
 
//membaca file excel yang diupload
 $data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
 //membaca jumlah baris dari data excel
 $baris = $data->rowcount($sheet_index=0);
 
//nilai awal counter jumlah data yang sukses dan yang gagal diimport
 $sukses = 0;
 $gagal = 0;
 
//import data excel dari baris kedua, karena baris pertama adalah nama kolom
 for ($i=2; $i<= $baris; $i++) {
 //membaca data kode (kolom ke-2)
 $kode = $data->val($i,1);
 
 //membaca data nama barang
 $namasup = $data->val($i,2);
 //membaca data brand
 $alamat = $data->val($i,3);
 //membaca data lengan
 $notel = $data->val($i,4);
 //membaca data warna
 $sales = $data->val($i,5);
 //membaca data ukuran
 $nosales = $data->val($i,6);
 
 
//setelah data dibaca, sisipkan ke dalam tabel pegawai
if ($kode!=''){
 $query = "INSERT INTO tb_supplier values ('$kode','$namasup','$alamat','$notel','$sales','$nosales')";
 $hasil = mysql_query($query);
 
//menambah counter jika berhasil atau gagal
 if($hasil) $sukses++;
 else $gagal++;
}
}
 //tampilkan report hasil import
 echo "<h4> Proses Import Data Selesai</h4>";
 echo "<p>Jumlah data sukses diimport : ".$sukses."<br><br>";
 echo "Jumlah data gagal diimport : ".$gagal."<p>";

 
?>

<a href="./" class="btn btn-warning">Kembali</a>