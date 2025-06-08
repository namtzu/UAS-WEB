<?php
include "koneksi.php";  

$nama   = $_POST['nama'];
$ulasan = $_POST['pesan'];
$rating = $_POST['bintang']; 

if ($rating < 1 || $rating > 5) {
  die("Rating tidak valid.");
}


$nama   = mysqli_real_escape_string($id_mysql, $nama);
$ulasan = mysqli_real_escape_string($id_mysql, $ulasan);
$rating = (int)$rating;

$insert = "INSERT INTO tabel_testimoni (namaPemberiTestimoni, isiTestimoni, jumlahBintang) VALUES ('$nama', '$ulasan', $rating)";
$insert_query = mysqli_query($id_mysql, $insert);

if (!$insert_query) {
  die("Data Gagal Diinputkan! Error: " . mysqli_error($id_mysql));
}

echo "Testimoni berhasil disimpan!";
?>
