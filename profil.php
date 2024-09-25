<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_toko");

session_start();
if(!isset($_SESSION['user'])) {
  header('Location: login.php');
}

$query = "SELECT * FROM tb_user where id='$_SESSION[id_user]'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <script src="../assets/js/color-modes.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.122.0">
  <title>Profil | Anda</title>
  <link rel="icon" href="chibi.png" type="image/x-icon">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>  
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
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
  <main>
    <div class="container marketing" method="post">
      <div class="row">
        <!-- Profil Card -->
        <div class="col-lg-4">
          <div class="card mb-4 mt-5 shadow">
            <div class="card-body text-center">
              <img src="pp.jpeg" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3"><?=$data ['username']?></h5>
              <p class="text-muted mb-4"><?=$data ['alamat']?></p>
              <div class="d-flex justify-content-center mb-2">
              <a href="login.php" class="btn btn-danger me-3" role="button" id="logoutButton">Logout</a>
              <a href="editprofil.php" name="edit" class="btn btn-warning" role="button">Edit</a>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('logoutButton').addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah tombol untuk langsung mengarah ke halaman login.php
        
        Swal.fire({
            title: 'Apakah Anda yakin ingin keluar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Keluar',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'login.php'; // Arahkan ke halaman logout
            }
        });
    });
</script>
            </div>
            </div>
          </div>
        </div>

        <!-- Detail Table -->
        <div class="col-lg-8" method="post">
          <div class="card mb-4 mt-5 shadow">
            <div class="card-body">
              <table class="table">
                <tbody>
                <div class="col-md-8">
				<table class="table table-border">
					<tr><th colspan="2">Profil | Anda</th></tr>
                    <tr><th><i class="bi bi-person-circle"></i> Nama</th><td><?=$data ['nama']?></td></tr>
					<tr><th><i class="bi bi-envelope"></i> Email</th><td><?=$data ['email']?></td></tr>
                    <tr><th><i>@</i> Username</th><td><?=$data ['username']?></td></tr>
                    <tr>
    <th><i class="bi bi-lock-fill"></i> Password</th>
    <td>
        <div class="input-group">
            <input type="password" class="form-control" id="passwordField" value="<?=$data['password']?>" readonly>
            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                <i class="bi bi-eye-fill" id="eyeIcon"></i>
            </button>
        </div>
    </td>
</tr>
<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        var passwordField = document.getElementById('passwordField');
        var eyeIcon = document.getElementById('eyeIcon');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('bi-eye-fill');
            eyeIcon.classList.add('bi-eye-slash-fill');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('bi-eye-slash-fill');
            eyeIcon.classList.add('bi-eye-fill');
        }
    });
</script>

					<tr><th><i class="bi bi-geo-alt-fill"></i> Alamat</th><td><?=$data ['alamat']?></td></tr>
					<tr><th><i class="bi bi-telephone-fill"></i> No. Handphone</th><td><?=$data ['hp']?></td></tr>
				</table>
			</div>
		</div>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js" integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous"></script>
  <script src="dashboard.js"></script>
</body>
</html>
