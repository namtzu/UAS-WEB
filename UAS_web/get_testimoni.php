<?php 
include "koneksi.php";
$result = mysqli_query($id_mysql, "
SELECT * FROM tabel_testimoni

");

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = [
        'nama'   => $row['namaPemberiTestimoni'],
        'ulasan' => $row['isiTestimoni'],
        'rating' => (int)$row['jumlahBintang']
  ];
}

header('Content-Type: application/json');
echo json_encode($data);
?>
