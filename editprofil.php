<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_toko");

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$id = $_SESSION['id_user']; 
$query = "SELECT * FROM tb_user WHERE id='$id'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'] ?: $data['nama'];
    $email = $_POST['email'] ?: $data['email'];
    $username = $_POST['username'] ?: $data['username'];
    $password = $_POST['password'] ?: $data['password'];
    $hp = $_POST['hp'] ?: $data['hp'];
    $alamat = $_POST['alamat'] ?: $data['alamat'];

    $query = "UPDATE tb_user SET nama='$nama', email='$email', username='$username', password='$password', hp='$hp', alamat='$alamat' WHERE id='$id'";
    $simpan = mysqli_query($koneksi, $query);

    if ($simpan) {
        header("Location: profil.php");
        exit();
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit | Profil</title>
    <link rel="icon" href="chibi.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">ChibiClothing.store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Recommendation</a>
                </li>
            </ul>
            <form class="d-flex fs-5" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <div class="d-flex ms-3">
                <a href="profil.php" class="text-white me-3"><box-icon name='user-circle' color='#ffffff'></box-icon></a>
                <a href="keranjang.php"><box-icon name='cart' type='solid' color='#ffffff'></box-icon></a>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <form class="form-group" method="post">
        <div class="mb-2 p-2 bg rounded">
            <h2 class="text-center">Edit Profil Anda</h2>
            <label for="nama" class="form-label mt-3 fw-semibold">Nama</label>
            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" value="<?= $data['nama'] ?>"/>
            
            <label for="email" class="form-label mt-3 fw-semibold">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?= $data['email'] ?>"/>
            
            <label for="username" class="form-label mt-3 fw-semibold">Username</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="<?= $data['username'] ?>"/>
            
            <label for="password" class="form-label mt-3 fw-semibold">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="<?= $data['password'] ?>"/>
            
            <label for="hp" class="form-label mt-3 fw-semibold">No. Handphone</label>
            <input type="text" name="hp" class="form-control" id="hp" placeholder="No. Handphone" value="<?= $data['hp'] ?>"/>
            
            <label for="alamat" class="form-label mt-3 fw-semibold">Alamat</label>
            <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat" value="<?= $data['alamat'] ?>"/>
            
            <button type="submit" name="simpan" class="btn btn-success mt-4">Simpan</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>
</html>
