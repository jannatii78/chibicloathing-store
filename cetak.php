<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek out Now</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="chibi.png" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/navbars/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <style>
          @media print {
            .nav-item,        /* Menyembunyikan item menu "Menu" dan "Recommendation" */
            .d-flex,          /* Menyembunyikan seluruh kontainer yang berisi form pencarian dan ikon */
            .form-control,    /* Menyembunyikan input search bar */
            .btn-outline-success, /* Menyembunyikan tombol search */
            .btn-primary {    /* Menyembunyikan tombol Cetak Nota */
                display: none !important;
            }
        }
    </style>
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
  <div class="container mt-5">
    <?php
    // Koneksi ke database
    $koneksi = mysqli_connect("localhost", "root", "", "db_toko");

    // Mengambil ID transaksi dari URL
    $id = $_GET['id'];

    // Query untuk mendapatkan detail transaksi
    $trans = "SELECT * FROM tb_detail INNER JOIN tb_transaksi ON tb_detail.id_transaksi = tb_transaksi.id_transaksi WHERE tb_detail.id_transaksi='$id'";
    $query = mysqli_query($koneksi, $trans);
    $data = mysqli_fetch_assoc($query);

    // Query untuk mendapatkan informasi pelanggan
    $res = "SELECT * FROM tb_transaksi INNER JOIN tb_user ON tb_transaksi.id_pelanggan = tb_user.id WHERE tb_transaksi.id_transaksi='$id'";
    $query2 = mysqli_query($koneksi, $res);
    $user = mysqli_fetch_assoc($query2);
    ?>

    <div style="clear: both;"></div>
    <h3 class="title2">Nota Pembelian</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>No. Invoice</th>
                <td>INV-<?= $id ?></td>
            </tr>
            <tr>
                <th>Nama Pembeli</th>
                <td><?= ucfirst($user['nama']) ?></td>
            </tr>
            <tr>
                <th>Tanggal Pembelian</th>
                <td><?= $data['tanggal'] ?></td>
            </tr>
        </table>
        
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th width="70%">Nama Barang</th>
                    <th width="30%">Qty</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk mendapatkan detail produk
                $prod = "SELECT * FROM tb_detail INNER JOIN produk ON tb_detail.id_produk = produk.id WHERE tb_detail.id_transaksi='$id'";
                $query3 = mysqli_query($koneksi, $prod);

                while ($row = mysqli_fetch_array($query3)) {
                ?>
                    <tr>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['jumlah'] ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td><strong>Grand Total</strong></td>
                    <td align="right"><strong>Rp <?= number_format($data['total_harga']); ?></strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Tombol Cetak -->
        <div class="text-end mt-4">
        <button onclick="window.print()" class="btn btn-primary btn-cetak">Cetak Nota</button>
    </div>
    </div>
  </div>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


