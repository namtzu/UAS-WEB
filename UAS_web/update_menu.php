<?php
include "koneksi.php";
$id_menu=$_GET['id'];

$query = "SELECT*FROM tabel_menu WHERE idMenu='$id_menu'";
$data = mysqli_query($id_mysql,$query) or die("gagal".mysqli_error());
$row = mysqli_fetch_array($data);
?>

<form name="form1" method="post" action="">
    <h2>Update Data Menu</h2>

    <table width="500" border="0">
        <tr>
            <td>Nama Menu</td>
            <td><input type="text" name="nama_menu" value="<?php echo"$row[1]";?>"></td>
        </tr>
        <tr>
            <td>Harga Menu</td>
            <td><input type="text" name="harga_menu" value="<?php echo"$row[2]";?>"></td>
        </tr>
        <tr>
            <td>Deskripsi</td>
            <td><textarea name="deskripsi" rows="5" cols="40" value=""><?php echo"$row[3]";?></textarea></td>
        </tr>
        <tr>
            <td>Direktori Gambar</td>
            <td><input type="text" name="direktori" value="<?php echo"$row[4]";?>"></td>
        </tr>
        <tr>
            <td>Kategori</td>
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
            <td><input type="submit" name="update" value="update"></td>
        </tr>
    </table>
</form>

<!update data ke db>
<?php
include "koneksi.php";
if (isset($_POST['update'])){
    $nama = $_POST["nama_menu"];
    $harga = $_POST["harga_menu"];
    $deskripsi = $_POST["deskripsi"];
    $dir = $_POST["direktori"];
    $idKategori = $_POST["id_kategori"];

    $update = "UPDATE tabel_menu set namaMenu='$nama', hargaMenu='$harga',
    deskripsiMenu='$deskripsi',direktoriGambar='$dir', id_Kategori='$idKategori'
    WHERE idMenu='$id_menu'";
    $update_query = mysqli_query($id_mysql,$update);

    if(!$update_query) die("Data Gagal Diinputkan!");
    echo "<meta http-equiv=Refresh content=0;url=edit_menu.php>";
}
?>