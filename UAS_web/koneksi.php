<?php
$pengguna = "root";
$password = "";
$host = "localhost";
$database = "labbaik_chicken";
$id_mysql = mysqli_connect($host,$pengguna,$password,$database);
if(!$id_mysql) 
{
    die("Database Tidak Bisa Dibuka");
}
?>