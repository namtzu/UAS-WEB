<!--input-->
<form name="form1" method="post" action="">
    <h2>Input Data Menu</h2>

    <table width="500" border="0">
        <tr>
            <td>Kategori: </td>
            <td><select name="id_kategori">
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
            <td>Nama Menu</td>
            <td><input type="text" name="nama_menu"></td>
        </tr>
        <tr>
            <td>Harga Menu</td>
            <td><input type="text" name="harga_menu"></td>
        </tr>
        <tr>
            <td>Deskripsi Menu</td>
            <td><textarea name="deskripsi_menu" rows="5" cols="40"></textarea></td>
        </tr>
        <tr>
            <td>Direktori Gambar</td>
            <td><input type="text" name="dir_gambar"></td>
        </tr>
        <tr>
            <td><input type="submit" name="input" value="input"></td>
        </tr>
    </table>
</form>

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

");


$jumlah_record = mysqli_num_rows($result);
echo "<h3>Tabel Data Buku</h3>";
echo "<Table border='1'>";
echo "<tr>
<th>ID Menu</th>
<th>Nama Menu</th>
<th>Harga Menu</th>
<th>Deskripsi Menu</th>
<th>Direktori Gambar</th>
<th>Kategori</th>
<th>Proeses</th>
</tr>";
while($row = mysqli_fetch_row($result)) {
    echo "<tr>
    <td>$row[0]</td>
    <td>$row[1]</td>
    <td>$row[2]</td>
    <td>$row[3]</td>
    <td>$row[4]</td>
    <td>$row[5]</td>
    <td><a href=update_menu.php?id=$row[0]>Update</a> <a href='edit_menu.php?delete_id=$row[0]'>Delete</a></td>
    </tr>";
}
echo "<tr><td colspan='7'>Jumlah Record : $jumlah_record</td></tr>";
echo "</Table>";
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