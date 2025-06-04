<?php 
include "koneksi.php";
$result = mysqli_query($id_mysql, "
SELECT m.namaMenu, m.hargaMenu, m.deskripsiMenu, m.direktoriGambar, k.namaKategori, k.idKategori
FROM tabel_menu m
LEFT JOIN tabel_kategori k ON m.id_Kategori = k.idKategori
ORDER BY k.idKategori ASC

");

$menuByKategori = [];

while ($row = mysqli_fetch_assoc($result)) {
    $kategori = $row['namaKategori'] ?? 'Tanpa Kategori';
    $menuByCategory[$kategori][] = [
        'name' => $row['namaMenu'],
        'price' => $row['hargaMenu'],
        'img_directory' => $row['direktoriGambar'],
        'description' => $row['deskripsiMenu']
    ];
}

// Siapkan data dalam array JSON
$output = [];
foreach ($menuByCategory as $kategori => $items) {
    $output[] = [
        'category' => $kategori,
        'items' => $items
    ];
}

header('Content-Type: application/json');
echo json_encode(['menu' => $output], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>
