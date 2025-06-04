<?php
include "koneksi.php";
$id_menu=$_GET['id'];

$query = "SELECT*FROM tabel_menu WHERE idMenu='$id_menu'";
$data = mysqli_query($id_mysql,$query) or die("gagal".mysqli_error());
$row = mysqli_fetch_array($data);
?>
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
</style>
<form name="form1" method="post" action="">
    <h2 class = "subhead"><span class = "action">Update</span><span class = "data-menu">Data Menu</span></h2>
    <div class = "form">
    <table width="500" border="0">
        <tr>
            <td class = "non-input">Kategori : </td>
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
            <td class = "non-input">Nama Menu : </td>
            <td><input type="text" name="nama_menu" value="<?php echo"$row[1]";?>"></td>
        </tr>
        <tr>
            <td class = "non-input">Harga Menu : </td>
            <td><input type="text" name="harga_menu" value="<?php echo"$row[2]";?>"></td>
        </tr>
        <tr>
            <td class = "non-input">Deskripsi Menu : </td>
            <td><textarea name="deskripsi" rows="5" cols="22" value=""><?php echo"$row[3]";?></textarea></td>
        </tr>
        <tr>
            <td class = "non-input">Direktori Gambar : </td>
            <td><input type="text" name="direktori" value="<?php echo"$row[4]";?>"></td>
        </tr>
        <tr>
            <td colspan='2' style = "text-align: center;"><input type="submit" name="update" value="update"></td>
        </tr>
    </table>
    </div>
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