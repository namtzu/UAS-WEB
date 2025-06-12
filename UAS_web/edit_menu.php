

<!--input-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/ico"/>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>INDEX</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jaro:opsz@6..72&display=swap" rel="stylesheet">

</head>
<style>
body{
    background-color: rgba(253, 246, 239, 1);
    font-family: 'Poppins', sans-serif;
  
}
.subhead {
    font-family: "Jaro", sans-serif;
    font-size:10vh;
    font-optical-sizing: auto;
    font-weight: 10;
    font-style: normal;
    display: flex;
    justify-content: center;
}
.form {
    display: flex;
    justify-content: center;
}
.tabel-menu{
    display: flex;
    justify-content: center;
}
.action {
  color: #4e261a; /* dark brown */
  margin-right: 1%
}
.data-menu {
  color: #e87741; /* orange */
  margin-left: 4px; /* space between words */
}
.non-input {
    text-align: right;
    vertical-align: top;
}
.form input[type = "text"], .form select, .form textarea{
    width = 320px;
    box-sizing: border-box;
}

</style>
<script>
/*$(document).ready(function() {
    $('form[name="form1"]').on('submit', function(e) {
        let isValid = true;
        let errorMessage = "";

        // Cek input teks
        $('input[type="text"], textarea, select', this).each(function() {
            if ($(this).val().trim() === "") {
                isValid = false;
                errorMessage = "Semua field harus diisi!";
                return false; // keluar dari .each()
            }
        });

        if (!isValid) {
            alert(errorMessage);
            e.preventDefault(); // cegah submit
        }
    });
});
</script>
<body>
   <form name="form1" method="post" action="">
    <h2 class="subhead"><span class = "action">Input</span><span class = "data-menu">Data Menu</span></h2>
    <div class="form">
        <table width="500" border="0" >
            <tr>
                <td class = "non-input">Kategori :</td>
                <td><select name="id_kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                        <?php
                        include "koneksi.php";
                        $query = mysqli_query($id_mysql, "SELECT idKategori, namaKategori FROM tabel_kategori");
                        while ($data = mysqli_fetch_assoc($query)) {
                            echo "<option value='" . $data['idKategori'] . "'>" . $data['namaKategori'] . "</option>";
                        }
                        ?>
                        </select>
                </td>
            </tr>
            <tr>
                <td class = "non-input">Nama Menu : </td>
                <td><input type="text" name="nama_menu" required></td>
            </tr>
            <tr>
                <td class = "non-input">Harga Menu : </td>
                <td><input type="text" name="harga_menu" required></td>
            </tr>
            <tr>
                <td class = "non-input">Deskripsi Menu : </td>
                <td><textarea name="deskripsi_menu" rows="5" cols="22" required></textarea></td>
            </tr>
            <tr>
                <td class = "non-input">Direktori Gambar : </td>
                <td><input type="text" name="dir_gambar" required></td>
            </tr>
            <tr>
                <td colspan='2' style = "text-align: center;"><input type="submit" name="input" value="input"></td>
            </tr>
        </table>
    </div>
    </form>
</body>

<!input data ke database>
<?php 
include "koneksi.php";
if(isset($_POST['input'])){
    $nama = $_POST["nama_menu"];
    $harga = $_POST["harga_menu"];
    $deskripsi = $_POST["deskripsi_menu"];
    $dir = $_POST["dir_gambar"];
    $kategori = $_POST["id_kategori"];

    $insert = "INSERT INTO tabel_menu (namaMenu, hargaMenu, deskripsiMenu, 
              direktoriGambar, id_Kategori) VALUES ('$nama','$harga','$deskripsi','$dir',
              '$kategori')";
    $insert_query = mysqli_query($id_mysql,$insert);

    if(!$insert_query) die("Data Gagal Diinputkan!");
}
?>

<?php 
$result = mysqli_query($id_mysql, "
SELECT m.idMenu, m.namaMenu, m.hargaMenu, m.deskripsiMenu, m.direktoriGambar, k.namaKategori
FROM tabel_menu m
LEFT JOIN tabel_kategori k ON m.id_Kategori = k.idKategori
ORDER BY k.idKategori ASC

");

$menuByKategori = [];

while ($row = mysqli_fetch_assoc($result)) {
    $kategori = $row['namaKategori'] ?? 'Tanpa Kategori';
    $menuByKategori[$kategori][] = $row;
}

// Tampilkan HTML
echo "<h3 class='subhead'><span class='action'>Tabel</span><span class='data-menu'>Data Menu</span></h3>";
echo "<div class='tabel-menu'>";
echo "<table border='0' style='overflow-y: auto; text-align: center;'>";

foreach ($menuByKategori as $kategori => $items) {
    // Header kategori
    echo "<tr class='category-row'>
            <td colspan='6' style='text-align: center; background-color:rgb(238, 94, 27); color:rgb(78, 38, 26);'><strong>$kategori</strong></td>
          </tr>";

    // Header kolom menu
    echo "<tr>
            <th>ID Menu</th>
            <th>Nama Menu</th>
            <th>Harga Menu</th>
            <th>Deskripsi Menu</th>
            <th>Direktori Gambar</th>
            <th>Proses</th>
          </tr>";

    foreach ($items as $item) {
        echo "<tr>
                <td>{$item['idMenu']}</td>
                <td>{$item['namaMenu']}</td>
                <td>Rp{$item['hargaMenu']}</td>
                <td>{$item['deskripsiMenu']}</td>
                <td>{$item['direktoriGambar']}</td>
                <td>
                    <a href='update_menu.php?id={$item['idMenu']}'>Update</a> 
                    <a href='edit_menu.php?delete_id={$item['idMenu']}'>Delete</a>
                </td>
              </tr>";
    }
}

echo "</table>";
echo "</div>";



?>

<?php
include "koneksi.php";
if(isset($_GET['delete_id']))
{
    $id_menu = $_GET['delete_id'];
    $query="DELETE FROM tabel_menu WHERE idMenu='$id_menu'";
    mysqli_query($id_mysql,$query);
    echo "<meta http-equiv=Refresh content=0;url=edit_menu.php>";
}
?>