<?php 
$koneksi = mysqli_connect("localhost", "root", "", "db_toko");

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE from produk where id='$id'");
if ($query) {
    header('Location: dashboard.php');
}
?>

