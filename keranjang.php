<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "db_toko");

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['add'])) {
    if (isset($_POST['id_produk'], $_POST['quantity'])) {
        $id_produk = $_POST['id_produk'];
        $quantity = intval($_POST['quantity']);

        $query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id='$id_produk'");
        $produk = mysqli_fetch_assoc($query);

        if ($produk) {
            $item_array = array(
                'id' => $produk['id'],
                'nama' => $produk['nama'],
                'harga' => $produk['harga'],
                'foto' => $produk['foto'],
                'jumlah' => $quantity
            );

            if (isset($_SESSION['cart'])) {
                $item_array_id = array_column($_SESSION['cart'], 'id');
                if (!in_array($id_produk, $item_array_id)) {
                    $_SESSION['cart'][] = $item_array;
                } else {
                    ?>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'info',
                                title: 'Item sudah ada di keranjang',
                                showConfirmButton: true
                            });
                        });
                    </script>
                    <?php
                }
            } else {
                $_SESSION['cart'][] = $item_array;
            }
            ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: " Item berhasil dimasukkan ke keranjang!",
                        showConfirmButton: false,
                        timer: 2500,
                        backdrop: 'white'
                    }).then(function() {
                        window.location.href = 'keranjang.php';
                    });
                });
            </script>
            <?php
        } else {
            ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "warning",
                        title: "Produk tidak ditemukan!",
                        backdrop: "white",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(function() {
                        window.location.href = 'keranjang.php';
                    });
                });
            </script>
            <?php
        }
    }
}

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
    $id = $_GET['id'];
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['id'] == $id) {
            $nama = $value['nama']; // Ambil nama produk untuk notifikasi
            unset($_SESSION['cart'][$key]);
            ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Item berhasil dihapus!",
                        showConfirmButton: false,
                        timer: 1000,
                        backdrop: 'white'
                    }).then(function() {
                        window.location.href = 'keranjang.php';
                    });
                });
            </script>
            <?php
            break;
        }
    }
}

if (isset($_GET['aksi']) && $_GET['aksi'] == 'beli') {
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += ($item['jumlah'] * $item['harga']);
        }

        $id_pelanggan = $_SESSION['id_user'];
        $query = mysqli_query($koneksi, "INSERT INTO tb_transaksi (tanggal, id_pelanggan, total_harga) VALUES (NOW(), '$id_pelanggan', '$total')");
        $id_transaksi = mysqli_insert_id($koneksi);

        foreach ($_SESSION['cart'] as $item) {
            $id_produk = $item['id'];
            $jumlah = $item['jumlah'];
            $sql = "INSERT INTO tb_detail (id_transaksi, id_produk, jumlah) VALUES ('$id_transaksi', '$id_produk', '$jumlah')";
            mysqli_query($koneksi, $sql);

            $sql_update_stok = "UPDATE produk SET stok = stok - '$jumlah' WHERE id='$id_produk'";
            mysqli_query($koneksi, $sql_update_stok);
        }

        unset($_SESSION['cart']);
        ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Terima Kasih!",
                    text: "Terima kasih sudah berbelanja",
                    icon: "success",
                    confirmButtonText: "Tutup",
                    timer: 5000,
                    backdrop: 'white'
                }).then(function() {
                    window.location.href = 'cetak.php?id=<?php echo $id_transaksi; ?>';
                });
            });
        </script>
        <?php
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Keranjang | Anda</title>
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
  <br>
    <div class="mt-5">
    <div class="text-center mb-4">
    <h3>Keranjang | anda</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $item):
                ?>
                <tr>
                    <td>
                        <img src="img/<?= $item['foto'] ?>" height="100px"> <?= $item['nama'] ?>
                    </td>
                    <td><?= $item['jumlah'] ?></td>
                    <td>Rp. <?= number_format($item['harga']) ?></td>
                    <td>Rp. <?= number_format($item['jumlah'] * $item['harga']) ?></td>
                    <td>
                        <a href="keranjang.php?aksi=hapus&id=<?= $item['id'] ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php
                    $total += $item['jumlah'] * $item['harga'];
                    endforeach;
                } else {
                ?>
                <tr>
                    <td colspan="5" class="text-center">Keranjang kosong</td>
                </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Total:</td>
                    <td>Rp. <?= number_format($total); ?></td>
                    <td>
                        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                        <a href="keranjang.php?aksi=beli" class="btn btn-primary">Beli</a>
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>