<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "db_toko");

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id) {
    $query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id='$id'");
    $produk = mysqli_fetch_assoc($query);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Produk</title>
    <link rel="icon" href="chibi.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body><nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
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
  <br>
    <div class="container mt-5">
        <?php if ($produk): ?>
        <div class="row">
            <div class="col-md-5">
                <img src="img/<?= $produk['foto'] ?>" class="img-fluid" alt="<?= $produk['nama'] ?>">
            </div>
            <div class="col-md-7">
                <h1><?= $produk['nama'] ?></h1>
                <p><?= $produk['deskripsi'] ?></p>
                <p class="lead">Rp. <?= number_format($produk['harga']) ?></p>
                <p>Stok tersedia: <?= $produk['stok'] ?></p>
                <form action="keranjang.php" method="post">
                    <input type="hidden" name="id_produk" value="<?= $produk['id'] ?>">
                    <label for="quantity" class="form-label" style="font-size: 0.8rem;">Kuantitas:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?= $produk['stok'] ?>" class="form-control mb-3">
                    <button type="submit" name="add" class="btn btn-warning">Tambah Ke Keranjang</button>
                </form>
            </div>
        </div>
        <?php else: ?>
        <p>Produk tidak ditemukan.</p>
        <?php endif; ?>
    </div>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
